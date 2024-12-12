<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <h4 class="header-title">Form Penyusutan Aset</h4>

            <form id="form-tambah">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="id_aset" class="col-form-label">Aset</label>
                        <select class="form-control" id="id_aset" name="id_aset">
                            <option value="">Pilih Kelompok Aset</option>
                            <?php
                            include '../../config.php';
                            $sql = $conn->query("SELECT * FROM aset");
                            while ($data = $sql->fetch_assoc()) {
                                echo '<option value="' . $data['id_aset'] . '" data-nama="' . $data['nama_aset'] . '" data-residu="' . $data['nilai_residu'] . '" data-umur="' . $data['umur_ekonomis'] . '">' . $data['nama_aset'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tanggal_penyusutan" class="col-form-label">Tanggal Penyusutan</label>
                        <input type="date" class="form-control" id="tanggal_penyusutan" name="tanggal_penyusutan">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="umur_ekonomis" class="col-form-label">Umur Ekonomis (Bulan)</label>
                        <input type="text" class="form-control" id="umur_ekonomis" name="umur_ekonomis" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nilai_penyusutan" class="col-form-label">Nilai Penyusutan</label>
                        <input type="text" class="form-control" id="nilai_penyusutan" name="nilai_penyusutan" readonly>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah</button>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#id_aset').on('change', function () {
            var data = $(this).find(':selected').data();
            $('#umur_ekonomis').val(data.umur);
            $('#nilai_penyusutan').val(data.residu);

        })
        $('#form-tambah').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'pages/daftar-penyusutan/proses-penyusutan-aset.php?aksi=tambah',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response == "ok") {
                        loadTable();
                        $('#myModal').modal('hide');
                        alertify.success('Penyusutan Aset Berhasil Diajukan');

                    } else {
                        alertify.error('Penyusutan Aset Gagal Diajukan');

                    }
                }
            });
        });
    });
</script>