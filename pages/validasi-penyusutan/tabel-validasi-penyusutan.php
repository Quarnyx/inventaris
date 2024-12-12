<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Tabel Data Validasi Penyusutan</b></h4>

            <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Aset</th>
                        <th>Umur Ekonomis</th>
                        <th>Sisa Umur</th>
                        <th>Penyusutan</th>
                        <th>Sisa Nilai</th>
                        <th>Tanggal Penyusutan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT
                                                    jadwal_penyusutan.*, 
                                                    aset.*
                                                FROM
                                                    jadwal_penyusutan
                                                INNER JOIN
                                                    aset
                                                ON 
                                                    jadwal_penyusutan.id_aset = aset.id_aset");
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
                                <?php echo $data['umur_ekonomis']; ?> Tahun / <?php echo $data['umur_ekonomis'] * 12; ?>
                                Bulan
                            </td>
                            <td>
                                <?php
                                $sisa_umur = $data['sisa_umur'];
                                echo $sisa_umur;
                                ?> Bulan

                            </td>
                            <td>
                                <?php echo 'Rp. ' . number_format($data['nilai_penyusutan'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <?php
                                $umur_ekonomis = $data['umur_ekonomis'] * 12;
                                $total_sisa_umur = $umur_ekonomis - $sisa_umur;
                                // echo 'sisa umur = ' . $umur_ekonomis . ' - ' . $sisa_umur . ' = ' . $total_sisa_umur;
                                $nilai_penyusutan = $data['nilai_penyusutan'] * $total_sisa_umur;
                                // echo '<br>nilai penyusutan = ' . $data['nilai_penyusutan'] . ' * ' . $total_sisa_umur . ' = ' . $nilai_penyusutan;
                                $sisa_nilai = $data['harga_pembelian'] - $nilai_penyusutan;
                                echo 'Rp. ' . number_format($sisa_nilai, 0, ',', '.');
                                ?>
                            </td>
                            <td>
                                <?php echo $data['tanggal_penyusutan']; ?>
                            </td>
                            <td>
                                <?php
                                if ($data['validasi'] == 'Sudah Validasi') {
                                    echo $data['validasi'];
                                } else {

                                    ?>
                                    <button data-id="<?php echo $data['id_jadwal']; ?>" id="delete"
                                        data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-success btn-sm"><i
                                            class="fe-check"></i> Validasi</button>
                                <?php } ?>
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
        $('#datatable').on('click', '#delete', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            alertify.confirm('Validasi', 'Validasi penyusutan aset ' + nama + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/validasi-penyusutan/proses-validasi-penyusutan.php?aksi=validasi',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            alertify.success('Penyusutan Aset Berhasil');

                        } else {
                            alertify.error('Penyusutan Aset Gagal');

                        }
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Validasi dibatalkan');
            })
        });
    });
</script>