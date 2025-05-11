<?php
include '../../config.php';
?>
<form id="form-tambah" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id_aset">Aset</label>
        <select class="form-control" id="id_aset" name="id_aset" required>
            <option value="">Pilih Aset</option>
            <?php
            $query = $conn->query("SELECT id_aset, nama_aset FROM aset WHERE status = 'Sudah Validasi Tambah Aset'");
            while ($row = $query->fetch_assoc()) {
                echo "<option value='" . $row['id_aset'] . "'>" . $row['nama_aset'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tanggal_pemindahtanganan">Tanggal Pemindahtanganan</label>
        <input type="date" class="form-control" id="tanggal_pemindahtanganan" name="tanggal_pemindahtanganan" required>
    </div>
    <div class="form-group">
        <label for="metode">Metode</label>
        <select class="form-control" id="metode" name="metode" required>
            <option value="">Pilih Metode</option>
            <option value="Jual">Jual</option>
            <option value="Hibah">Hibah</option>
            <option value="Tukar Guling">Tukar Guling</option>
            <option value="Pemberian">Pemberian</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pihak_penerima">Pihak Penerima</label>
        <input type="text" class="form-control" id="pihak_penerima" name="pihak_penerima" required>
    </div>
    <div class="form-group">
        <label for="dokumen_pendukung">Dokumen Pendukung</label>
        <input type="file" class="form-control" id="dokumen_pendukung" name="dokumen_pendukung" accept=".pdf,.doc,.docx"
            required>
        <small class="text-muted">Format yang didukung: PDF, DOC, DOCX</small>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#form-tambah').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('act', 'tambah');

            $.ajax({
                url: 'pages/pemindahtanganan-aset/proses-pemindahtanganan-aset.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response == 'success') {
                        $('#myModal').modal('hide');
                        loadTable();
                        alertify.success('Data berhasil ditambahkan');
                    } else {
                        alertify.error('Data gagal ditambahkan');
                    }
                }
            });
        });
    });
</script>