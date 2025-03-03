<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Tambah Aset</h4>

            <form id="form-tambah">
                <input type="hidden" name="id_pengguna" value="">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nama-aset" class="col-form-label">Nama Aset</label>
                        <select class="form-control" id="nama-aset" name="id_aset">
                            <option value="">Pilih Aset</option>
                            <?php
                            include '../../config.php';
                            $sql = $conn->query("SELECT
                                                            kelompok_aset.nama_kelompok, 
                                                            aset.nama_aset, 
                                                            aset.id_aset
                                                        FROM
                                                            aset
                                                            INNER JOIN
                                                            kelompok_aset
                                                            ON 
                                                                aset.id_kelompok = kelompok_aset.id_kelompok");
                            while ($data = $sql->fetch_assoc()) {
                                echo '<option value="' . $data['id_aset'] . '">' . $data['nama_aset'] . ' - ' . $data['nama_kelompok'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="letak-aset" class="col-form-label">Letak Aset</label>
                        <input type="text" class="form-control" id="letak-aset" placeholder="Letak Aset"
                            name="letak_aset">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <textarea type="text" class="form-control" id="keterangan" placeholder="Keterangan"
                            name="keterangan"></textarea>
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
                url: 'pages/letak-aset/proses-letak-aset.php?aksi=tambah',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Letak Aset Berhasil Ditambah');

                    } else {
                        alertify.error('Letak Aset Gagal Ditambah');

                    }
                }
            });
        });
    });
</script>