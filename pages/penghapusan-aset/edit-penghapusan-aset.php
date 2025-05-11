<?php
include '../../config.php';
$id = $_POST['id'];
$sql = $conn->query("SELECT * FROM penghapusan_aset WHERE id_penghapusan = '$id'");
$data = $sql->fetch_assoc();
?>
<form id="form-edit" enctype="multipart/form-data">
    <input type="hidden" name="id_penghapusan" value="<?php echo $data['id_penghapusan']; ?>">
    <div class="form-group">
        <label for="id_aset">Pilih Aset</label>
        <select class="form-control" name="id_aset" id="id_aset" required>
            <option value="">Pilih Aset</option>
            <?php
            $sql2 = $conn->query("SELECT * FROM aset WHERE status = 'Sudah Validasi Tambah Aset' OR id_aset = '" . $data['id_aset'] . "'");
            while ($data2 = $sql2->fetch_assoc()) {
                $selected = ($data2['id_aset'] == $data['id_aset']) ? 'selected' : '';
                echo '<option value="' . $data2['id_aset'] . '" ' . $selected . '>' . $data2['nama_aset'] . '</option>';
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="tanggal_penghapusan">Tanggal Penghapusan</label>
        <input type="date" class="form-control" name="tanggal_penghapusan" id="tanggal_penghapusan"
            value="<?php echo $data['tanggal_penghapusan']; ?>" required>
    </div>
    <div class="form-group">
        <label for="alasan">Alasan</label>
        <textarea class="form-control" name="alasan" id="alasan" rows="3"
            required><?php echo $data['alasan']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="metode_penghapusan">Metode Penghapusan</label>
        <select class="form-control" name="metode_penghapusan" id="metode_penghapusan" required>
            <option value="">Pilih Metode</option>
            <option value="Jual" <?php echo ($data['metode_penghapusan'] == 'Jual') ? 'selected' : ''; ?>>Jual</option>
            <option value="Hibah" <?php echo ($data['metode_penghapusan'] == 'Hibah') ? 'selected' : ''; ?>>Hibah</option>
            <option value="Musnah" <?php echo ($data['metode_penghapusan'] == 'Musnah') ? 'selected' : ''; ?>>Musnah
            </option>
            <option value="Rusak" <?php echo ($data['metode_penghapusan'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
        </select>
    </div>
    <div class="form-group">
        <label for="dokumen_pendukung">Dokumen Pendukung</label>
        <?php if ($data['dokumen_pendukung']) { ?>
            <div class="mb-2">
                <a href="../../pages/penghapusan-aset/dokumen/<?php echo $data['dokumen_pendukung']; ?>" target="_blank"
                    class="btn btn-info btn-sm">
                    <i class="fe-file-text"></i> Lihat Dokumen Saat Ini
                </a>
            </div>
        <?php } ?>
        <input type="file" class="form-control" name="dokumen_pendukung" id="dokumen_pendukung">
        <small class="text-muted">Format yang didukung: PDF, JPG, PNG (Max. 2MB)</small>
        <input type="hidden" name="dokumen_lama" value="<?php echo $data['dokumen_pendukung']; ?>">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(document).ready(function () {
        $('#form-edit').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: 'pages/penghapusan-aset/proses-penghapusan-aset.php?aksi=edit',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    if (data == "ok") {
                        $('#myModal').modal('hide');
                        loadTable();
                        alertify.success('Data Penghapusan Aset Berhasil Diubah');
                    } else {
                        alertify.error('Data Penghapusan Aset Gagal Diubah');
                    }
                },
                error: function (data) {
                    alertify.error(data);
                }
            })
        })
    })
</script>