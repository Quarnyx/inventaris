<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Tabel Data Aset</b></h4>

            <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Aset</th>
                        <th>Nama Aset</th>
                        <th>Harga Perolehan</th>
                        <th>Tanggal Perolehan</th>
                        <th>Umur Ekonomis</th>
                        <th>Nilai Residu</th>
                        <th>Status</th>
                        <th>Nama Kelompok</th>
                        <th>Letak Aset</th>
                        <th>Deskripsi</th>
                        <th>Nilai Penyusutan</th>
                        <th>Merk</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th>Sumber Dana</th>
                        <th>Klasifikasi Pengadaan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT
	letak_aset.letak_aset, 
	kelompok_aset.nama_kelompok, 
	aset.id_aset, 
	aset.nama_aset, 
	aset.tanggal_pembelian, 
	aset.umur_ekonomis, 
	aset.harga_pembelian, 
	aset.nilai_residu, 
	aset.`status`, 
	aset.id_jenis, 
	aset.id_kelompok, 
	aset.deskripsi_aset, 
	aset.jumlah, 
	aset.unit, 
	aset.nilai_penyusutan, 
	aset.kode_aset, 
	aset.merek, 
	aset.status_kondisi, 
	aset.sumber_dana, 
	aset.klasifikasi_pengadaan, 
	aset.keterangan_tolak
FROM
	aset
	LEFT JOIN
	letak_aset
	ON 
		aset.id_aset = letak_aset.id_aset
	INNER JOIN
	kelompok_aset
	ON 
		aset.id_kelompok = kelompok_aset.id_kelompok");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['kode_aset']; ?>
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
                                <?php echo $data['umur_ekonomis']; ?> Tahun
                            </td>
                            <td>
                                <?php echo 'Rp. ' . number_format($data['nilai_residu'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <?php echo $data['status']; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_kelompok']; ?>
                            </td>
                            <td>
                                <?php echo $data['letak_aset']; ?>
                            </td>
                            <td>
                                <?php echo $data['deskripsi_aset']; ?>
                            </td>
                            <td>
                                <?php echo 'Rp. ' . number_format($data['nilai_penyusutan'], 0, ',', '.'); ?>
                            </td>
                            <td>
                                <?php echo $data['merek']; ?>
                            </td>
                            <td>
                                <?php echo $data['jumlah']; ?>
                            </td>
                            <td>
                                <?php echo $data['status_kondisi']; ?>
                            </td>
                            <td>
                                <?php echo $data['sumber_dana']; ?>
                            </td>
                            <td>
                                <?php echo $data['klasifikasi_pengadaan']; ?>
                            </td>
                            <td>
                                <button data-id="<?php echo $data['id_aset']; ?>" id="edit"
                                    data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-warning btn-sm"><i
                                        class="fe-edit"></i></button>
                                <button data-id="<?php echo $data['id_aset']; ?>" id="delete"
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
                url: 'pages/aset/edit-aset.php',
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
                    url: 'pages/aset/proses-aset.php?aksi=hapus',
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