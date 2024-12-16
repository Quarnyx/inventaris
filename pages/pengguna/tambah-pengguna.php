<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Tambah Pengguna</h4>

            <form id="form-tambah">
                <input type="hidden" name="id_pengguna" value="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama_pengguna" class="col-form-label">Nama Pengguna</label>
                        <input type="text" class="form-control" id="nama_pengguna" placeholder="Nama Pengguna"
                            name="nama_pengguna">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="password" class="col-form-label">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password"
                            name="password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="username" class="col-form-label">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="level" class="col-form-label">Level</label>
                        <select id="level" name="level" class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="Pengurus">Pengurus Aset</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
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
                url: 'pages/pengguna/proses-pengguna.php?aksi=tambah',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Pengguna Berhasil Ditambah');

                    } else {
                        alertify.error('Pengguna Gagal Ditambah');

                    }
                }
            });
        });
    });
</script>