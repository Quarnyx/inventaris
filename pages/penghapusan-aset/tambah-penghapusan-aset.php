<?php
include '../../config.php';
?>
<form id="form-tambah" enctype="multipart/form-data">
    <div class="form-group">
        <label for="id_aset">Pilih Aset</label>
        <select class="form-control" name="id_aset" id="id_aset" required>
            <option value="">Pilih Aset</option>
            <?php
            $sql = $conn->query("SELECT * FROM aset WHERE status = 'Sudah Validasi Tambah Aset'");
            while ($data = $sql->fetch_assoc()) {
                echo '<option value="' . $data['id_aset'] . '">' . $data['nama_aset'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tanggal_penghapusan">Tanggal Penghapusan</label>
        <input type="date" class="form-control" name="tanggal_penghapusan" id="tanggal_penghapusan" required>
    </div>
    <div class="form-group">
        <label for="alasan">Alasan</label>
        <textarea class="form-control" name="alasan" id="alasan" rows="3" required></textarea>
    </div>
    <div class="form-group">
        <label for="metode_penghapusan">Metode Penghapusan</label>
        <select class="form-control" name="metode_penghapusan" id="metode_penghapusan" required>
            <option value="">Pilih Metode</option>
            <option value="Jual">Jual</option>
            <option value="Hibah">Hibah</option>
            <option value="Musnah">Musnah</option>
            <option value="Rusak">Rusak</option>
        </select>
    </div>
    <div class="form-group">
        <label for="dokumen_pendukung">Dokumen Pendukung</label>
        <input type="file" class="form-control" name="dokumen_pendukung" id="dokumen_pendukung">
        <small class="text-muted">Format yang didukung: PDF, JPG, PNG (Max. 2MB)</small>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#form-tambah').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: 'pages/penghapusan-aset/proses-penghapusan-aset.php?aksi=tambah',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data == "ok") {
                        $('#myModal').modal('hide');
                        loadTable();
                        alertify.success('Data Penghapusan Aset Berhasil Ditambahkan');
                    } else {
                        alertify.error('Data Penghapusan Aset Gagal Ditambahkan');
                    }
                },
                error: function (data) {
                    alertify.error(data);
                }
            })
        })
    })
</script>