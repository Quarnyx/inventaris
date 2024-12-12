<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Tabel Data Penyusutan Aset</b></h4>

            <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Aset</th>
                        <th>Umur Ekonomis</th>
                        <th>Penyusutan</th>
                        <th>Tanggal Penyusutan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT
                                                    aset.*, 
                                                    jadwal_penyusutan.*
                                                FROM
                                                    aset
                                                INNER JOIN
                                                    jadwal_penyusutan
                                                ON 
                                                    aset.id_aset = jadwal_penyusutan.id_aset");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_aset']; ?>
                            </td>
                            <td>
                                <?php echo $data['umur_ekonomis']; ?> Tahun
                            </td>
                            <td>
                                <?php echo 'Rp. ' . number_format($data['nilai_penyusutan'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <?php echo $data['tanggal_penyusutan']; ?>
                            </td>
                            <td>
                                <button data-id="<?php echo $data['id_jadwal']; ?>" id="edit"
                                    data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-warning btn-sm"><i
                                        class="fe-edit"></i></button>
                                <button data-id="<?php echo $data['id_jadwal']; ?>" id="delete"
                                    data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-danger btn-sm"><i
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
                url: 'pages/daftar-penyusutan/edit-penyusutan-aset.php',
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
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data penyusutan aset ' + nama + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/daftar-penyusutan/proses-penyusutan-aset.php?aksi=hapus',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            alertify.success('Penyusutan Aset Berhasil Dihapus');

                        } else {
                            alertify.error('Penyusutan Aset Gagal Dihapus');

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