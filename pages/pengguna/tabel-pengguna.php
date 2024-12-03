<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Tabel Data Pengguna</b></h4>

            <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT * FROM pengguna");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_pengguna']; ?>
                            </td>
                            <td>
                                <?php echo $data['username']; ?>
                            </td>
                            <td>
                                <?php echo $data['level']; ?>
                            </td>
                            <td>
                                <button data-id="<?php echo $data['id_pengguna']; ?>" id="edit"
                                    data-nama="<?php echo $data['nama_pengguna']; ?>" class="btn btn-warning btn-sm"><i
                                        class="fe-edit"></i></button>
                                <button data-id="<?php echo $data['id_pengguna']; ?>" id="delete"
                                    data-nama="<?php echo $data['nama_pengguna']; ?>" class="btn btn-danger btn-sm"><i
                                        class="fe-trash"></i></button>
                                <button data-id="<?php echo $data['id_pengguna']; ?>" id="ganti-password"
                                    data-nama="<?php echo $data['nama_pengguna']; ?>" class="btn btn-info btn-sm"><i
                                        class="fe-lock"></i></button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
        $('#datatable').on('click', '#edit', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            $.ajax({
                type: 'POST',
                url: 'pages/pengguna/edit-pengguna.php',
                data: 'id=' + id + '&nama=' + nama,
                success: function (data) {
                    $('#myModal').modal('show');
                    $('.modal-title').html('Edit Data ' + nama);
                    $('.modal .modal-body').html(data);
                }
            })
        });
        $('#datatable').on('click', '#ganti-password', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            alertify.prompt('Ganti Password ' + nama, 'Masukkan Password Baru', '', function (evt, value) {
                $.ajax({
                    type: 'POST',
                    url: 'pages/pengguna/proses-pengguna.php?aksi=ganti-password',
                    data: 'id=' + id + '&nama=' + nama + '&password=' + value,
                    success: function (data) {
                        if (data == "ok") {
                            alertify.success('Ganti Password Berhasil');

                        } else {
                            alertify.error('Ganti Password Gagal');

                        }
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Ganti password dibatalkan');
            })
        });
        $('#datatable').on('click', '#delete', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data ' + nama + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/pengguna/proses-pengguna.php?aksi=hapus',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            alertify.success('Pengguna Berhasil Dihapus');

                        } else {
                            alertify.error('Pengguna Gagal Dihapus');

                        }
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Hapus dibatalkan');
            })
        });
    });
</script>