<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Tambah Aset</h4>

            <form id="form-tambah">
                <input type="hidden" name="id_pengguna" value="">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="nama_aset" class="col-form-label">Nama Aset</label>
                        <input type="text" class="form-control" id="nama_aset" placeholder="Nama Aset" name="nama_aset">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="harga_pembelian" class="col-form-label">Harga Perolehan</label>
                        <input type="text" class="form-control" id="harga_pembelian" placeholder="Harga Pembelian"
                            name="harga_pembelian">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="tanggal_pembelian" class="col-form-label">Tanggal Perolehan</label>
                        <input type="date" class="form-control" id="tanggal_pembelian" placeholder="Tanggal Pembelian"
                            name="tanggal_pembelian">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="umur_ekonomis" class="col-form-label">Umur Ekonomis (Tahun)</label>
                        <input type="text" class="form-control" id="umur_ekonomis" placeholder="Umur Ekonomis"
                            name="umur_ekonomis">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nilai_residu" class="col-form-label">Nilai Residu</label>
                        <input type="text" class="form-control" id="nilai_residu" placeholder="Nilai Residu"
                            name="nilai_residu">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nilai_penyusutan" class="col-form-label">Nilai Penyusutan (Bulan)</label>
                        <input type="text" class="form-control" id="nilai_penyusutan" placeholder="Nilai Penyusutan"
                            name="nilai_penyusutan" readonly>
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="jumlah" class="col-form-label">Jumlah</label>
                        <input type="text" class="form-control" id="jumlah" placeholder="Jumlah" name="jumlah">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="satuan" class="col-form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" placeholder="Satuan" name="satuan">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="sumber_dana" class="col-form-label">Sumber Dana</label>
                        <select name="sumber_dana" class="form-control">
                            <?php
                            require_once '../../config.php';
                            $query = mysqli_query($conn, "SHOW COLUMNS FROM aset LIKE 'sumber_dana'");
                            $enum = explode("','", substr(mysqli_fetch_array($query)['Type'], 6, -2));
                            foreach ($enum as $key => $value) {
                                echo "<option value='$value'>$value</option>";
                            }

                            ?>
                        </select>
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
                                echo '<option value="' . $data['id_jenis'] . '">' . $data['nama_jenis'] . '</option>';
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
                                echo '<option value="' . $data['id_kelompok'] . '">' . $data['nama_kelompok'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="letak-aset" class="col-form-label">Letak Aset</label>
                        <input type="text" class="form-control" id="letak-aset" placeholder="Letak Aset"
                            name="letak_aset">
                    </div>
                </div>
                <div class="form-row">
                    <?php
                    require_once '../../config.php';
                    // generate kode aset
                    $query = mysqli_query($conn, "SELECT MAX(kode_aset) AS kode_aset FROM aset");
                    $data = mysqli_fetch_array($query);
                    $max = $data['kode_aset'] ? substr($data['kode_aset'], 3, 3) : "000";
                    $no = $max + 1;
                    $char = "AS-";
                    $kode_aset = $char . sprintf("%03s", $no);
                    ?>
                    <div class="form-group col-md-4">
                        <label for="kode_aset" class="col-form-label">Kode Aset</label>
                        <input type="text" class="form-control" id="kode_aset" placeholder="Kode Aset" name="kode_aset"
                            readonly value="<?php echo $kode_aset; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="status_kondisi" class="col-form-label">Status Kondisi</label>
                        <input type="text" class="form-control" id="status_kondisi" placeholder="Status Kondisi"
                            name="status_kondisi">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="merek" class="col-form-label">Merek</label>
                        <input type="text" class="form-control" id="merek" placeholder="Merek" name="merek">
                    </div>
                </div>
                <div class="form-row">
                    <label for="klasifikasi_pengadaan" class="col-form-label">Klasifikasi Pengadaan</label>
                    <select name="klasifikasi_pengadaan" class="form-control">
                        <?php
                        require_once '../../config.php';
                        $query = mysqli_query($conn, "SHOW COLUMNS FROM aset LIKE 'klasifikasi_pengadaan'");
                        $enum = explode("','", substr(mysqli_fetch_array($query)['Type'], 6, -2));
                        foreach ($enum as $key => $value) {
                            echo "<option value='$value'>$value</option>";
                        }

                        ?>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="deskripsi_aset" class="col-form-label">Deskripsi Aset</label>
                        <textarea type="text" class="form-control" id="deskripsi_aset" placeholder="Deskripsi Aset"
                            name="deskripsi_aset"></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // format harga_pembelian to rupiah
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
                url: 'pages/aset/proses-aset.php?aksi=tambah',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Aset Berhasil Ditambah');

                    } else {
                        alertify.error('Aset Gagal Ditambah');

                    }
                }
            });
        });
    });
</script>