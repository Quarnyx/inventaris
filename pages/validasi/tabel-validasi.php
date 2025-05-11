<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">

            <div class="row mb-3">
                <a href="?page=validasi&act=sudah" type="button"
                    class="btn btn-success btn-rounded waves-light waves-effect width-md mr-1">Sudah
                    Validasi</a>

                <a href="?page=validasi&act=belum" type="button"
                    class="btn btn-danger btn-rounded waves-light waves-effect width-md ml-1">Belum
                    Validasi</a>
            </div>
            <h4 class="header-title"><b>Tabel Data Validasi Aset</b></h4>
            <?php
            include '../../config.php';
            $no = 1;
            if ($_GET['act'] == 'sudah') {
                $sql = $conn->query("SELECT
                                                aset.*, 
                                                validasi.id_validasi,
                                                validasi.keterangan_validasi, 
                                                validasi.status_validasi, 
                                                validasi.bukti_dokumen
                                            FROM
                                                aset
                                            INNER JOIN
                                                validasi
                                            ON 
                                            aset.id_aset = validasi.id_aset");

                ?>
                <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Aset</th>
                            <th>Status Validasi</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;
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
                                    <?php echo $data['status_validasi']; ?>
                                </td>
                                <td>
                                    <?php echo $data['keterangan_validasi']; ?>
                                </td>
                                <td>
                                    <a href="pages/validasi/upload/<?php echo $data['bukti_dokumen']; ?>" target="_blank"
                                        class="btn btn-info btn-sm"><i class="fe-download"></i> Download</a>
                                    <button data-id="<?php echo $data['id_validasi']; ?>" id="edit"
                                        data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-warning btn-sm"><i
                                            class="fe-edit"></i> Edit Validasi</button>
                                    <button data-id="<?php echo $data['id_validasi']; ?>" id="delete"
                                        data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-danger btn-sm"><i
                                            class="fe-trash"></i></button>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            <?php }
            if ($_GET['act'] == 'belum') {
                $sql = $conn->query("SELECT * FROM aset WHERE status like '%Belum Validasi%' OR status like '%Perbaikan%'");


                ?>
                <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Aset</th>
                            <th>Harga Pembelian</th>
                            <th>Tanggal Pembelian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>


                    <tbody>
                        <?php
                        $no = 1;
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
                                    <?php echo 'Rp. ' . number_format($data['harga_pembelian'], 0, ',', '.'); ?>
                                </td>
                                <td>
                                    <?php echo $data['tanggal_pembelian']; ?>
                                </td>
                                <td>
                                    <?php echo $data['status']; ?>
                                </td>
                                <td>
                                    <button data-id="<?php echo $data['id_aset']; ?>" id="tambah"
                                        data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-success btn-sm"><i
                                            class="fe-check"></i> Validasi</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            <?php } ?>



        </div>
    </div>
</div> <!-- end row -->
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
        $('#datatable').on('click', '#tambah', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            $.ajax({
                type: 'POST',
                url: 'pages/validasi/tambah-validasi.php',
                data: 'id=' + id + '&nama=' + nama,
                success: function (data) {
                    $('#myModal').modal('show');
                    $('.modal-title').html('Validasi Aset ' + nama);
                    $('.modal .modal-body').html(data);
                }
            })
        });
        $('#datatable').on('click', '#edit', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            $.ajax({
                type: 'POST',
                url: 'pages/validasi/edit-validasi.php',
                data: 'id=' + id + '&nama=' + nama,
                success: function (data) {
                    $('#myModal').modal('show');
                    $('.modal-title').html('Validasi Aset ' + nama);
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
                    url: 'pages/validasi/proses-validasi.php?aksi=hapus',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            alertify.success('Jenis Aset Berhasil Dihapus');

                        } else {
                            alertify.error('Jenis Aset Gagal Dihapus');

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