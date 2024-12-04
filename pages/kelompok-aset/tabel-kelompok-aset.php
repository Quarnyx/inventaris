<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Tabel Data Kelompok Kelompok</b></h4>

            <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kelompok Kelompok</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT * FROM kelompok_aset");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_kelompok']; ?>
                            </td>
                            <td>
                                <?php echo $data['deskripsi_kelompok']; ?>
                            </td>
                            <td>
                                <button data-id="<?php echo $data['id_kelompok']; ?>" id="edit"
                                    data-nama="<?php echo $data['nama_kelompok']; ?>" class="btn btn-warning btn-sm"><i
                                        class="fe-edit"></i></button>
                                <button data-id="<?php echo $data['id_kelompok']; ?>" id="delete"
                                    data-nama="<?php echo $data['nama_kelompok']; ?>" class="btn btn-danger btn-sm"><i
                                        class="fe-trash"></i></button>
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
                url: 'pages/kelompok-aset/edit-kelompok-aset.php',
                data: 'id=' + id + '&nama=' + nama,
                success: function (data) {
                    $('#myModal').modal('show');
                    $('.modal-title').html('Edit Data ' + nama);
                    $('.modal .modal-body').html(data);
                }
            })
        });
        $('#datatable').on('click', '#delete', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data ' + nama + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/kelompok-aset/proses-kelompok-aset.php?aksi=hapus',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            alertify.success('Jenis Kelompok Berhasil Dihapus');

                        } else {
                            alertify.error('Jenis Kelompok Gagal Dihapus');

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