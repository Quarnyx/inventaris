<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Tambah Pemeliharaan Aset</h4>

            <form id="form-tambah">
                <input type="hidden" name="id_pengguna" value="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_aset" class="col-form-label">Nama Aset</label>
                        <select name="id_aset" id="id_aset" class="form-control">
                            <option value="">Pilih Aset</option>
                            <?php
                            include '../../config.php';
                            $sql = $conn->query("SELECT * FROM aset");
                            while ($data = $sql->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $data['id_aset']; ?>"><?php echo $data['nama_aset']; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_pemeliharaan" class="col-form-label">Tanggal Pemeliharaan</label>
                        <input type="date" class="form-control" id="tanggal_pemeliharaan"
                            placeholder="Tanggal Pemeliharaan" name="tanggal_pemeliharaan"></input>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="jenis_pemeliharaan" class="col-form-label">Jenis Pemeliharaan</label>
                        <input type="text" class="form-control" id="jenis_pemeliharaan" placeholder="Jenis Pemeliharaan"
                            name="jenis_pemeliharaan"></input>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="biaya" class="col-form-label">Biaya</label>
                        <input type="number" class="form-control" id="biaya" placeholder="Biaya" name="biaya"></input>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control"
                            placeholder="Keterangan"></textarea>
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
                url: 'pages/pemeliharaan-aset/proses-pemeliharaan-aset.php?aksi=tambah',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Pemeliharaan Aset Berhasil Ditambah');

                    } else {
                        alertify.error('Pemeliharaan Aset Gagal Ditambah');

                    }
                }
            });
        });
    });
</script>