<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Tambah Jenis Aset</h4>

            <form id="form-tambah">
                <input type="hidden" name="id_pengguna" value="">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="nama_jenis" class="col-form-label">Jenis Aset</label>
                        <input type="text" class="form-control" id="nama_jenis" placeholder="Nama Jenis Aset"
                            name="nama_jenis">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="deskripsi_jenis" class="col-form-label">Deskripsi Jenis Aset</label>
                        <textarea type="text" class="form-control" id="deskripsi_jenis"
                            placeholder="Deskripsi Jenis Aset" name="deskripsi_jenis"></textarea>
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
                url: 'pages/jenis-aset/proses-jenis-aset.php?aksi=tambah',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Jenis Aset Berhasil Ditambah');

                    } else {
                        alertify.error('Jenis Aset Gagal Ditambah');

                    }
                }
            });
        });
    });
</script>