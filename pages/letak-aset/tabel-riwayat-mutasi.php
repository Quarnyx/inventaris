<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Tabel Riwayat Mutasi Aset</b></h4>

            <table id="datatable2" class="table table-bordered  dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Aset</th>
                        <th>Kelompok Aset</th>
                        <th>Dari Lokasi</th>
                        <th>Ke Lokasi</th>
                        <th>Tanggal Mutasi</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT
                        kelompok_aset.nama_kelompok, 
                        aset.nama_aset, 
                        aset.id_aset, 
                        mutasi_aset.dari_lokasi,
                        mutasi_aset.ke_lokasi,
                        mutasi_aset.tanggal_mutasi,
                        mutasi_aset.keterangan,
                        mutasi_aset.id_mutasi
                    FROM
                        aset
                        INNER JOIN
                        kelompok_aset
                        ON 
                            aset.id_kelompok = kelompok_aset.id_kelompok
                        INNER JOIN
                        mutasi_aset
                        ON 
                            aset.id_aset = mutasi_aset.id_aset");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_aset']; ?>
                            </td>
                            <td><?php echo $data['nama_kelompok']; ?></td>
                            <td><?php echo $data['dari_lokasi']; ?></td>
                            <td><?php echo $data['ke_lokasi']; ?></td>
                            <td><?php echo $data['tanggal_mutasi']; ?></td>
                            <td><?php echo $data['keterangan']; ?></td>
                            <td>
                                <button data-id="<?php echo $data['id_mutasi']; ?>" id="delete"
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
        $('#datatable2').DataTable();
        $('#datatable2').on('click', '#delete', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data mutasi ' + nama + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/letak-aset/proses-letak-aset.php?aksi=hapus_mutasi',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadRiwayatMutasi();
                            alertify.success('Riwayat Mutasi Berhasil Dihapus');

                        } else {
                            alertify.error('Riwayat Mutasi Gagal Dihapus');

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