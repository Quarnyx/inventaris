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
                    <h5 class="card-title mb-0">Pilih Aset</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <form action="" method="get" class="row g-3">
                        <input type="hidden" name="page" value="penyusutan-per-tahun">
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
                            <h1>Laporan Penyusutan Aset</h1>
                            <h1><b>LAPAS KENDAL</b></h1>
                            <h1>Periode per Tahun</h1>
                        </div>
                    </div>
                </div>
                <hr style="border-width: 2px; border-color: black; border-style: solid;">
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
                if (isset($_GET['id_aset'])) {
                    $id_aset = $_GET['id_aset'];
                    $sql = $conn->query("SELECT * FROM aset WHERE id_aset = '$id_aset'");
                    $data = $sql->fetch_assoc();
                    // Data Aset
                    $tanggalPembelian = $data['tanggal_pembelian']; // Tanggal mulai digunakan
                    $hargaPerolehan = $data['harga_pembelian']; // Harga aset
                    $nilaiResidu = $data['nilai_residu']; // Nilai residu
                    $umurEkonomis = $data['umur_ekonomis']; // Umur ekonomis dalam tahun
                    $totalBulan = $umurEkonomis * 12; // Total penyusutan dalam bulan
                    $tanggalMulai = new DateTime($tanggalPembelian);
                    $nilaiPenyusutanBulanan = ($hargaPerolehan - $nilaiResidu) / $totalBulan;
                    $totalPenyusutan = 0;
                    $penyusutanTahunan = [];
                    $tahunSekarang = $tanggalMulai->format("Y");
                }


                ?>



                <hr>
                <div class="card-body">
                    <?php if (isset($_GET['id_aset'])) { ?>
                        <div class="">
                            <table class="mb-3">
                                <tr>
                                    <td style="min-width: 150px;">Nama Aset</td>
                                    <td>: </td>
                                    <td><?= $data['nama_aset'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pembelian</td>
                                    <td>: </td>
                                    <td><?= tanggal($data['tanggal_pembelian']) ?></td>
                                </tr>
                                <tr>
                                    <td>Harga Pembelian</td>
                                    <td>: </td>
                                    <td>Rp. <?= number_format($data['harga_pembelian'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>Umur Ekonomis</td>
                                    <td>: </td>
                                    <td><?= $data['umur_ekonomis'] ?> Tahun</td>
                                </tr>
                                <tr>
                                    <td>Nilai Residu</td>
                                    <td>: </td>
                                    <td>Rp. <?= number_format($data['nilai_residu'], 0, ',', '.') ?></td>
                                </tr>
                                <tr>
                                    <td>Nilai Penyusutan</td>
                                    <td>: </td>
                                    <td>Rp. <?= number_format($data['nilai_penyusutan'], 0, ',', '.') ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tahun</th>
                                        <th>Nilai Penyusutan</th>
                                        <th>Total Penyusutan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include "config.php";

                                    for ($i = 1; $i <= $totalBulan; $i++) {
                                        $tahun = $tanggalMulai->format("Y");

                                        // Jika masuk tahun baru, reset akumulasi tahun berjalan
                                        if (!isset($penyusutanTahunan[$tahun])) {
                                            $penyusutanTahunan[$tahun] = 0;
                                        }

                                        // Tambahkan nilai penyusutan bulan ini ke total tahunan
                                        $penyusutanTahunan[$tahun] += $nilaiPenyusutanBulanan;

                                        // Tambahkan total penyusutan kumulatif
                                        $totalPenyusutan += $nilaiPenyusutanBulanan;

                                        // Tambahkan 1 bulan ke tanggal mulai
                                        $tanggalMulai->modify("+1 month");
                                    }

                                    $nomor = 1;
                                    $totalKeseluruhan = 0;
                                    foreach ($penyusutanTahunan as $tahun => $nilai) {
                                        $totalKeseluruhan += $nilai;
                                        echo "<tr>
                                            <td>$nomor</td>
                                            <td>$tahun</td>
                                            <td>Rp " . number_format($nilai, 0, ',', '.') . "</td>
                                            <td>Rp " . number_format($totalKeseluruhan, 0, ',', '.') . "</td>
                                        </tr>";
                                        $nomor++;
                                    }

                                    // Cetak total akhir
                                    echo "<tr>
                                    <td colspan='2' align='center'><strong>Total</strong></td>
                                    <td><strong>Rp " . number_format($totalKeseluruhan, 0, ',', '.') . "</strong></td>
                                    <td><strong>Rp " . number_format($totalKeseluruhan, 0, ',', '.') . "</strong></td>
                                </tr>";
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
                    <?php } else {
                        echo "<div class='alert alert-danger'>Aset tidak ditemukan</div>";
                    } ?>
                </div> <!-- end card body-->

            </div> <!-- end card -->

        </div><!-- end col-->
    </div>
    <!-- end row-->






</div>