<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistem Akuntansi</a></li>
                        <li class="breadcrumb-item active">Laporan Penyusutan Aset</li>
                    </ol>
                </div>
                <h4 class="page-title">Laporan Penyusutan Aset</h4>
            </div>

        </div>
    </div>
    <div class="row d-print-none">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Filter Tanggal</h5>
                </div><!-- end card header -->
                <?php
                function tanggal($tanggal)
                {
                    $bulan = array(
                        1 => 'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    );
                    $split = explode('-', $tanggal);
                    return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
                }
                $daritanggal = "";
                $sampaitanggal = "";

                if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal'])) {
                    $daritanggal = $_GET['dari_tanggal'];
                    $sampaitanggal = $_GET['sampai_tanggal'];
                }

                ?>
                <div class="card-body">
                    <form action="" method="get" class="row g-3">
                        <input type="hidden" name="page" value="laporan">
                        <div class="col-md-4">
                            <label for="validationDefault01" class="form-label">Daftar Aset</label>
                            <select class="form-control" name="id_aset" id="validationDefault01" required="">
                                <option value="Semua">Semua</option>
                                <?php
                                include "config.php";
                                $sql = $conn->query("SELECT * FROM aset");
                                while ($data = $sql->fetch_assoc()) {
                                    echo '<option value="' . $data['id_aset'] . '">' . $data['nama_aset'] . '</option>';
                                }
                                ?>

                            </select>

                        </div>
                        <div class="col-md-4">
                            <label for="validationDefault01" class="form-label">Kelompok Aset</label>
                            <select class="form-control" name="id_kelompok" id="validationDefault01" required="">
                                <option value="Semua">Semua</option>
                                <?php
                                include "config.php";
                                $sql = $conn->query("SELECT * FROM kelompok_aset");
                                while ($data = $sql->fetch_assoc()) {
                                    echo '<option value="' . $data['id_kelompok'] . '">' . $data['nama_kelompok'] . '</option>';
                                }
                                ?>

                            </select>

                        </div>
                        <div class="col-md-4">
                            <label for="validationDefault02" class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-control" id="validationDefault02" required=""
                                name="sampai_tanggal">
                        </div>
                        <div class="col-12 mt-3">
                            <button class="btn btn-primary" type="submit">Pilih</button>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div>
    </div>
    <!-- end row-->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="row align-self-center">
                    <div class="text-center d-flex align-items-center">
                        <div>
                        </div>
                        <div class="ms-3">
                            <h1>Laporan Aset</h1>
                            <h1><b>LAPAS KENDAL</b></h1>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12 text-center">
                        <h6>
                        </h6>
                    </div>
                </div>
                <hr style="border-width: 2px; border-color: black; border-style: solid;">
                <h4 class="text-center mt-3 mb-3"><b>LAPORAN PENYUSUTAN ASET</b><br>Periode <?php
                if (!empty($_GET["sampai_tanggal"])) {
                    echo " Sampai Tanggal :  " . tanggal($_GET['sampai_tanggal']);
                } else {
                    echo "Semua";
                }
                ?></h4>
                <hr>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Aset</th>
                                    <th>Jenis</th>
                                    <th>Kelompok</th>
                                    <th>Harga Pembelian</th>
                                    <th>Umur Ekonomis</th>
                                    <th>Penyusutan</th>
                                    <th>Akum.Penyusutan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "config.php";
                                if (isset($_GET['sampai_tanggal'])) {
                                    $kondisi = "WHERE jadwal_penyusutan.tanggal_penyusutan <= '" . $_GET['sampai_tanggal'] . "'";
                                } else {
                                    $kondisi = "";
                                }
                                if (isset($_GET['id_aset']) && $_GET['id_aset'] != "Semua") {
                                    $kondisi_aset = "AND aset.id_aset = '" . $_GET['id_aset'] . "'";
                                } else {
                                    $kondisi_aset = "";
                                }
                                if (isset($_GET['id_kelompok']) && $_GET['id_kelompok'] != "Semua") {
                                    $kondisi_kelompok = "AND aset.id_kelompok = '" . $_GET['id_kelompok'] . "'";
                                } else {
                                    $kondisi_kelompok = "";
                                }
                                $sql = $conn->query("SELECT
                                                    SUM( jadwal_penyusutan.nilai_jadwal_penyusutan ) AS akumpenyusutan,
                                                    aset.nama_aset,
                                                    aset.harga_pembelian,
                                                    kelompok_aset.nama_kelompok,
                                                    jenis_aset.nama_jenis,
                                                    aset.jumlah,
                                                    aset.unit,
                                                    jadwal_penyusutan.sisa_umur,
                                                    aset.id_aset,
                                                    jadwal_penyusutan.id_jadwal,
                                                    aset.umur_ekonomis,
                                                    aset.nilai_penyusutan
                                                FROM
                                                    jadwal_penyusutan
                                                    INNER JOIN aset ON jadwal_penyusutan.id_aset = aset.id_aset
                                                    INNER JOIN kelompok_aset ON aset.id_kelompok = kelompok_aset.id_kelompok
                                                    INNER JOIN jenis_aset ON aset.id_jenis = jenis_aset.id_jenis 
                                                $kondisi
                                                $kondisi_aset
                                                $kondisi_kelompok
                                                GROUP BY
                                                    id_aset 
                                                ORDER BY
                                                    sisa_umur DESC");
                                $no = 1;
                                while ($data = $sql->fetch_assoc()) {

                                    ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama_aset'] ?></td>
                                        <td><?= $data['nama_jenis'] ?></td>
                                        <td><?= $data['nama_kelompok'] ?></td>
                                        <td>Rp. <?= number_format($data['harga_pembelian'], 0, ',', '.') ?></td>
                                        <td><?= $data['umur_ekonomis'] ?> Tahun /
                                            <?php echo $data['umur_ekonomis'] * 12 ?> Bulan
                                        </td>
                                        <td>Rp. <?= number_format($data['nilai_penyusutan'], 0, ',', '.') ?></td>
                                        <td>Rp. <?= number_format($data['akumpenyusutan'], 0, ',', '.') ?></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                    <div class="mt-4 mb-1">
                        <div class="text-end d-print-none">
                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                    class="mdi mdi-printer me-1"></i> Print</a>
                        </div>
                    </div>
                </div> <!-- end card body-->

            </div> <!-- end card -->

        </div><!-- end col-->
    </div>
    <!-- end row-->






</div>