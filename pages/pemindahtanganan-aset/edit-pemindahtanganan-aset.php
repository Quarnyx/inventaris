<?php
include '../../config.php';
$id = $_GET['id'];
$query = $conn->query("SELECT * FROM pemindahtanganan_aset WHERE id_pemindahtanganan = '$id'");
$data = $query->fetch_assoc();
?>
<form id="form-edit" enctype="multipart/form-data">
    <input type="hidden" name="id_pemindahtanganan" value="<?php echo $data['id_pemindahtanganan']; ?>">
    <div class="form-group">
        <label for="id_aset">Aset</label>
        <select class="form-control" id="id_aset" name="id_aset" required>
            <option value="">Pilih Aset</option>
            <?php
            $query = $conn->query("SELECT id_aset, nama_aset FROM aset");
            while ($row = $query->fetch_assoc()) {
                $selected = ($row['id_aset'] == $data['id_aset']) ? 'selected' : '';
                echo "<option value='" . $row['id_aset'] . "' " . $selected . ">" . $row['nama_aset'] . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tanggal_pemindahtanganan">Tanggal Pemindahtanganan</label>
        <input type="date" class="form-control" id="tanggal_pemindahtanganan" name="tanggal_pemindahtanganan"
            value="<?php echo $data['tanggal_pemindahtanganan']; ?>" required>
    </div>
    <div class="form-group">
        <label for="metode">Metode</label>
        <select class="form-control" id="metode" name="metode" required>
            <option value="">Pilih Metode</option>
            <option value="Jual" <?php echo ($data['metode'] == 'Jual') ? 'selected' : ''; ?>>Jual</option>
            <option value="Hibah" <?php echo ($data['metode'] == 'Hibah') ? 'selected' : ''; ?>>Hibah</option>
            <option value="Tukar Guling" <?php echo ($data['metode'] == 'Tukar Guling') ? 'selected' : ''; ?>>Tukar Guling
            </option>
            <option value="Pemberian" <?php echo ($data['metode'] == 'Pemberian') ? 'selected' : ''; ?>>Pemberian</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pihak_penerima">Pihak Penerima</label>
        <input type="text" class="form-control" id="pihak_penerima" name="pihak_penerima"
            value="<?php echo $data['pihak_penerima']; ?>" required>
    </div>
    <div class="form-group">
        <label for="dokumen_pendukung">Dokumen Pendukung</label>
        <?php if ($data['dokumen_pendukung']) { ?>
            <div class="mb-2">
                <a href="pages/pemindahtanganan-aset/dokumen_pendukung/<?php echo $data['dokumen_pendukung']; ?>"
                    target="_blank" class="btn btn-info btn-sm">
                    <i class="fe-file-text"></i> Lihat Dokumen
                </a>
            </div>
        <?php } ?>
        <input type="file" class="form-control" id="dokumen_pendukung" name="dokumen_pendukung"
            accept=".pdf,.doc,.docx">
        <small class="text-muted">Format yang didukung: PDF, DOC, DOCX. Biarkan kosong jika tidak ingin mengubah
            dokumen.</small>
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea class="form-control" id="keterangan" name="keterangan"
            rows="3"><?php echo $data['keterangan']; ?></textarea>
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#form-edit').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            formData.append('act', 'edit');

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
                        alertify.success('Data berhasil diupdate');
                    } else {
                        alertify.error('Data gagal diupdate');
                    }
                }
            });
        });
    });
</script>