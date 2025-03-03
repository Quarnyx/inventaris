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
                            value="<?php echo $row['nama_aset']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="harga_pembelian" class="col-form-label">Harga Pembelian</label>
                        <input type="text" class="form-control" id="harga_pembelian" placeholder="Harga Pembelian"
                            name="harga_pembelian"
                            value="Rp. <?php echo number_format($row['harga_pembelian'], 0, ',', '.'); ?>">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="tanggal_pembelian" class="col-form-label">Tanggal Pembelian</label>
                        <input type="date" class="form-control" id="tanggal_pembelian" placeholder="Tanggal Pembelian"
                            name="tanggal_pembelian" value="<?php echo $row['tanggal_pembelian']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="umur_ekonomis" class="col-form-label">Umur Ekonomis (Tahun)</label>
                        <input type="text" class="form-control" id="umur_ekonomis" placeholder="Umur Ekonomis"
                            name="umur_ekonomis" value="<?php echo $row['umur_ekonomis']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nilai_residu" class="col-form-label">Nilai Residu</label>
                        <input type="text" class="form-control" id="nilai_residu" placeholder="Nilai Residu"
                            name="nilai_residu"
                            value="<?php echo 'Rp. ' . number_format($row['nilai_residu'], 0, ',', '.'); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nilai_penyusutan" class="col-form-label">Nilai Penyusutan (Bulan)</label>
                        <input type="text" class="form-control" id="nilai_penyusutan" placeholder="Nilai Penyusutan"
                            name="nilai_penyusutan"
                            value="<?php echo 'Rp. ' . number_format($row['nilai_penyusutan'], 2, ',', '.'); ?>"
                            readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jumlah" class="col-form-label">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" placeholder="Jumlah" name="jumlah"
                            value="<?php echo $row['jumlah']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="satuan" class="col-form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" placeholder="Satuan" name="satuan"
                            value="<?php echo $row['unit']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="jenis_aset" class="col-form-label">Jenis Aset</label>
                        <select class="form-control" id="jenis_aset" name="id_jenis">
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
                    <div class="form-group col-md-4">
                        <label for="kelompok_aset" class="col-form-label">Kelompok Aset</label>
                        <select class="form-control" id="kelompok_aset" name="id_kelompok">
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
                    <div class="form-group col-md-4">
                        <label for="letak-aset" class="col-form-label">Letak Aset</label>
                        <input type="text" class="form-control" id="letak-aset" placeholder="Letak Aset"
                            name="letak_aset" value="<?php echo $row['letak_aset']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="deskripsi_aset" class="col-form-label">Deskripsi Aset</label>
                        <textarea type="text" class="form-control" id="deskripsi_aset" placeholder="Deskripsi Aset"
                            name="deskripsi_aset"><?php echo $row['deskripsi_aset']; ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-info">Update</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#harga_pembelian').keyup(function () {
            var value = $(this).val().replace(/[^\d]/g, "");
            $(this).val("Rp. " + value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
        })
        $('#nilai_residu').keyup(function () {
            var value = $(this).val().replace(/[^\d]/g, "");
            $(this).val("Rp. " + value.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
        })
        // hitung nilai penyusutan
        $('#nilai_residu, #umur_ekonomis, #harga_pembelian').keyup(function () {
            var harga_pembelian = $('#harga_pembelian').val().replace(/[^\d]/g, "");
            var umur_ekonomis = $('#umur_ekonomis').val().replace(/[^\d]/g, "");
            var nilai_residu = $('#nilai_residu').val().replace(/[^\d]/g, "");
            var nilai_penyusutan_tahunan = (harga_pembelian - nilai_residu) / umur_ekonomis;
            var nilai_penyusutan = nilai_penyusutan_tahunan / 12;

            $('#nilai_penyusutan').val("Rp. " + nilai_penyusutan.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
        })
        $('#form-tambah').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'pages/aset/proses-aset.php?aksi=edit',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Aset Berhasil Diedit');

                    } else {
                        alertify.error('Aset Gagal Diedit');

                    }
                }
            });
        });
    });
</script>