<?php
include "../../config.php";
$sql = "SELECT * FROM kelompok_aset WHERE id_kelompok = '$_POST[id]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Edit Kelompok Aset</h4>

            <form id="form-tambah">
                <input type="hidden" name="id" value="<?php echo $row['id_kelompok']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nama_kelompok" class="col-form-label">Kelompok Aset</label>
                        <input type="text" class="form-control" id="nama_kelompok" placeholder="Nama Kelompok Aset"
                            name="nama_kelompok" value="<?php echo $row['nama_kelompok']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="deskripsi_kelompok" class="col-form-label">Deskripsi Kelompok Aset</label>
                        <textarea type="text" class="form-control" id="deskripsi_kelompok"
                            placeholder="Deskripsi Kelompok Aset"
                            name="deskripsi_kelompok"><?php echo $row['deskripsi_kelompok']; ?></textarea>
                    </div>
                </div>

                <button type="submit" class="btn btn-info">Tambah</button>
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
                url: 'pages/kelompok-aset/proses-kelompok-aset.php?aksi=edit',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Kelompok Aset Berhasil Diedit');

                    } else {
                        alertify.error('Kelompok Aset Gagal Diedit');

                    }
                }
            });
        });
    });
</script>