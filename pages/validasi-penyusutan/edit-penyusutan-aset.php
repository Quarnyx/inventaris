<?php
include "../../config.php";
$sql = "SELECT * FROM jadwal_penyusutan WHERE id_jadwal = '$_POST[id]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Edit Penyusutan Aset</h4>

            <form id="form-tambah">
                <input type="hidden" name="id" value="<?php echo $row['id_jadwal']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_aset" class="col-form-label">Aset</label>
                        <select class="form-control" id="id_aset" name="id_aset" readonly>
                            <option value="">Pilih Kelompok Aset</option>
                            <?php
                            include '../../config.php';
                            $sql = $conn->query("SELECT * FROM aset");
                            while ($data = $sql->fetch_assoc()) {
                                echo '<option value="' . $data['id_aset'] . '" data-nama="' . $data['nama_aset'] . '" data-residu="' . $data['nilai_residu'] . '" data-umur="' . $data['umur_ekonomis'] . '"' . ($row['id_aset'] == $data['id_aset'] ? 'selected' : '') . '>' . $data['nama_aset'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_penyusutan" class="col-form-label">Tanggal Penyusutan</label>
                        <input type="date" class="form-control" id="tanggal_penyusutan" name="tanggal_penyusutan"
                            value="<?php echo $row['tanggal_penyusutan']; ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#form-tambah').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'pages/daftar-penyusutan/proses-penyusutan-aset.php?aksi=edit',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Pernyusutan Aset Berhasil Diedit');

                    } else {
                        alertify.error('Penyusutan Aset Gagal Diedit');

                    }
                }
            });
        });
    });
</script>