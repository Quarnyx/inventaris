<?php
include "../../config.php";
$sql = "SELECT * FROM pengguna WHERE id_pengguna = '$_POST[id]'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Edit Pengguna</h4>

            <form id="form-tambah">
                <input type="hidden" name="id" value="<?php echo $row['id_pengguna']; ?>">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nama_pengguna" class="col-form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" id="nama_pengguna" placeholder="Nama Pengguna"
                            name="nama_pengguna" value="<?php echo $row['nama_pengguna']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username" class="col-form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username"
                            value="<?php echo $row['username']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="level" class="col-form-label">Level</label>
                        <select id="level" name="level" class="form-control">
                            <option value="Admin" <?php if ($row['level'] == 'Admin')
                                echo 'selected'; ?>>Admin</option>
                            <option value="Operator" <?php if ($row['level'] == 'Operator')
                                echo 'selected'; ?>>Operator
                            </option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-info">Edit</button>
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
                url: 'pages/pengguna/proses-pengguna.php?aksi=edit',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Pengguna Berhasil Diedit');

                    } else {
                        alertify.error('Pengguna Gagal Diedit');

                    }
                }
            });
        });
    });
</script>