<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Tambah Jenis Kelompok</h4>

            <form id="form-tambah">
                <input type="hidden" name="id_pengguna" value="">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nama_kelompok" class="col-form-label">Jenis Kelompok</label>
                        <input type="text" class="form-control" id="nama_kelompok" placeholder="Nama Jenis Kelompok"
                            name="nama_kelompok">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="deskripsi_kelompok" class="col-form-label">Deskripsi Jenis Kelompok</label>
                        <textarea type="text" class="form-control" id="deskripsi_kelompok"
                            placeholder="Deskripsi Jenis Kelompok" name="deskripsi_kelompok"></textarea>
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
                url: 'pages/kelompok-aset/proses-kelompok-aset.php?aksi=tambah',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Jenis Kelompok Berhasil Ditambah');

                    } else {
                        alertify.error('Jenis Kelompok Gagal Ditambah');

                    }
                }
            });
        });
    });
</script>