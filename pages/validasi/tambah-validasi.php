<?php
include "../../config.php";
$sql = "SELECT * FROM aset WHERE id_aset = '$_POST[id]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Edit Aset</h4>

            <form id="form-tambah">
                <input type="hidden" name="id" value="<?php echo $row['id_aset']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nama_aset" class="col-form-label">Nama Aset</label>
                        <input type="text" class="form-control" id="nama_aset" placeholder="Nama Aset" name="nama_aset"
                            value="<?php echo $row['nama_aset']; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="harga_pembelian" class="col-form-label">Harga Pembelian</label>
                        <input type="text" class="form-control" id="harga_pembelian" placeholder="Harga Pembelian"
                            name="harga_pembelian"
                            value="Rp. <?php echo number_format($row['harga_pembelian'], 0, ',', '.'); ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tanggal_pembelian" class="col-form-label">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="tanggal_pembelian" placeholder="Tanggal Pembelian"
                            name="tanggal_pembelian" value="<?php echo $row['tanggal_pembelian']; ?>" disabled>
                    </div>
                </div>
                <div class="form-row">

                    <div class="form-group col-md-4">
                        <label for="umur_ekonomis" class="col-form-label">Umur Ekonomis (Bulan)</label>
                        <input type="text" class="form-control" id="umur_ekonomis" placeholder="Umur Ekonomis"
                            name="umur_ekonomis" value="<?php echo $row['umur_ekonomis']; ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nilai_residu" class="col-form-label">Nilai Residu</label>
                        <input type="text" class="form-control" id="nilai_residu" placeholder="Nilai Residu"
                            name="nilai_residu"
                            value="<?php echo 'Rp. ' . number_format($row['nilai_residu'], 0, ',', '.'); ?>" disabled>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nilai_penyusutan" class="col-form-label">Nilai Penyusutan (Bulan)</label>
                        <input type="text" class="form-control" id="nilai_penyusutan" placeholder="Nilai Penyusutan"
                            name="nilai_penyusutan"
                            value="<?php echo 'Rp. ' . number_format($row['nilai_penyusutan'], 0, ',', '.'); ?>"
                            readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jumlah" class="col-form-label">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" placeholder="Jumlah" name="jumlah"
                            value="<?php echo $row['jumlah']; ?>" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="satuan" class="col-form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" placeholder="Satuan" name="satuan"
                            value="<?php echo $row['unit']; ?>" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jenis_aset" class="col-form-label">Jenis Aset</label>
                        <select class="form-control" id="jenis_aset" name="id_jenis" disabled>
                            <option value="">Pilih Jenis Aset</option>
                            <?php
                            include '../../config.php';
                            $sql = $conn->query("SELECT * FROM jenis_aset");
                            while ($data = $sql->fetch_assoc()) {
                                echo '<option value="' . $data['id_jenis'] . '"' . ($row['id_jenis'] == $data['id_jenis'] ? 'selected' : '') . '>' . $data['nama_jenis'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="kelompok_aset" class="col-form-label">Kelompok Aset</label>
                        <select class="form-control" id="kelompok_aset" name="id_kelompok" disabled>
                            <option value="">Pilih Kelompok Aset</option>
                            <?php
                            include '../../config.php';
                            $sql = $conn->query("SELECT * FROM kelompok_aset");
                            while ($data = $sql->fetch_assoc()) {
                                echo '<option value="' . $data['id_kelompok'] . '" ' . ($row['id_kelompok'] == $data['id_kelompok'] ? 'selected' : '') . '>' . $data['nama_kelompok'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="deskripsi_aset" class="col-form-label">Deskripsi Aset</label>
                        <textarea type="text" class="form-control" id="deskripsi_aset" placeholder="Deskripsi Aset"
                            name="deskripsi_aset" disabled><?php echo $row['deskripsi_aset']; ?></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="keterangan_validasi" class="col-form-label">Keterangan Validasi</label>
                        <textarea type="text" class="form-control" id="keterangan_validasi"
                            placeholder="Keterangan Validasi Aset" name="keterangan_validasi" rows="5"></textarea>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="bukti_dokumen" class="col-form-label">Bukti Dokumen</label>
                        <div class="form-group mb-0">
                            <p>*Format file yang di izinkan hanya PDF dan JPG/JPEG, nama
                                dokumen sama dengan Nama Aset</p>
                            <input type="file" class="filestyle" data-btnClass="btn-primary" data-text="Pilih File"
                                name="bukti_dokumen">
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-info">Validasi</button>
            </form>
            <form id="form-tolak">
                <input type="hidden" name="id" value="<?php echo $row['id_aset']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="keterangan_tolak" class="col-form-label">Keterangan Tolak</label>
                        <textarea type="text" class="form-control" id="keterangan_tolak" placeholder="Keterangan Tolak"
                            name="keterangan_tolak" rows="5"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger mt-2">Tolak</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(":file").filestyle();
        $('#form-tolak').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'pages/validasi/proses-validasi.php?aksi=tolak-validasi',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Aset Berhasil Di Tolak');
                    } else {
                        alertify.error('Aset Gagal Di Tolak');
                    }
                }
            });
        });

        $('#form-tambah').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'pages/validasi/proses-validasi.php?aksi=tambah-validasi',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Aset Berhasil Di Validasi');

                    } else {
                        alertify.error('Aset Gagal Di Validasi');

                    }
                }
            });
        });
    });
</script>