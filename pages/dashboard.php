<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistem Akuntansi</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <?php
    include 'config.php';
    if ($_SESSION['level'] == 'admin') {
        $sql = $conn->query("SELECT * FROM aset WHERE status = 'Ditolak'");
        $jmlAsetDitolak = $sql->num_rows;
        if ($jmlAsetDitolak > 0) { ?>
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger">
                        <?php

                        while ($row = $sql->fetch_assoc()) {
                            ?>
                            <h4>Aset <?php echo $row['nama_aset']; ?> Ditolak </h4>
                            <p>Keterangan : <?php echo $row['keterangan_tolak']; ?></p>
                            <hr>
                            <?php
                        }
                        ?>
                        <a href="?page=aset" class="btn btn-primary">Cek Kembali</a>
                    </div>
                </div>
            </div>
            <?php
        }
    } ?>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card-box tilebox-one">
                <i class="fe-box float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Total Aset</h5>
                <?php
                include 'config.php';

                $query = "SELECT count(id_aset) as total FROM aset";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                ?>
                <h3 class="mb-3" data-plugin="counterup"><?php echo $row['total']; ?></h3>
                <span class="text-muted vertical-middle">Aset yang dimiliki</span>
            </div>
        </div>

        <div class="col-md-6 col-xl-5">
            <div class="card-box tilebox-one">
                <i class="fe-layers float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Nilai Aset</h5>
                <?php
                $query = "SELECT sum(harga_pembelian) as total_nilai FROM aset";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                ?>
                <h3 class="mb-3">Rp<span
                        data-plugin=""><?php echo number_format($row['total_nilai'], 0, ',', '.'); ?></span>
                </h3>
                <span class="text-muted vertical-middle">Nilai Pembelian Seluruh Aset</span>
            </div>
        </div>

        <div class="col-md-6 col-xl-4">
            <div class="card-box tilebox-one">
                <i class="fe-tag float-right"></i>
                <h5 class="text-muted text-uppercase mb-3 mt-0">Akum. Penyusutan Aset</h5>
                <?php
                $query = "SELECT sum(nilai_jadwal_penyusutan) as total_penyusutan FROM jadwal_penyusutan";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);

                ?>
                <h3 class="mb-3">Rp<span
                        data-plugin=""><?php echo number_format($row['total_penyusutan'], 0, ',', '.'); ?></span>
                </h3>
                <span class="text-muted vertical-middle">Akumulasi penyusutan seluruh aset</span>
            </div>
        </div>

    </div>
    <div class="row">
        <?php
        $sqljenisAset = mysqli_query($conn, "SELECT * FROM jenis_aset");
        $jmljenisAset = mysqli_num_rows($sqljenisAset);
        while ($rowjenisAset = mysqli_fetch_array($sqljenisAset)) {


            ?>


            <div class="col-md-6 col-xl-3">
                <div class="card-box tilebox-one">
                    <i class="fe-box float-right"></i>
                    <h5 class="text-muted text-uppercase mb-3 mt-0"><?php echo $rowjenisAset['nama_jenis']; ?></h5>
                    <?php
                    include 'config.php';

                    $query = "SELECT COUNT(id_aset) as total FROM aset WHERE id_jenis='" . $rowjenisAset['id_jenis'] . "'";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);

                    ?>
                    <h3 class="mb-3" data-plugin="counterup"><?php echo $row['total']; ?></h3>
                    <span class="text-muted vertical-middle">Aset yang dimiliki</span>
                </div>
            </div>

            <?php
        }
        ?>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <h4 class="header-title"><b>Tabel Data Aset</b></h4>
                <table id="datatable" class="table table-bordered  dt-responsive nowrap"
                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Aset</th>
                            <th>Harga Pembelian</th>
                            <th>Umur Ekonomis</th>
                            <th>Penyusutan</th>
                            <th>Akum.Penyusutan</th>
                            <th>Harga Aset</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "config.php";
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
                                <td>Rp. <?= number_format($data['harga_pembelian'], 0, ',', '.') ?></td>
                                <td><?= $data['umur_ekonomis'] ?> Tahun /
                                    <?php echo $data['umur_ekonomis'] * 12 ?> Bulan
                                </td>
                                <td>Rp. <?= number_format($data['nilai_penyusutan'], 0, ',', '.') ?></td>
                                <td>Rp. <?= number_format($data['akumpenyusutan'], 0, ',', '.') ?></td>
                                <td>Rp.
                                    <?= number_format($data['harga_pembelian'] - $data['akumpenyusutan'], 0, ',', '.') ?>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div> <!-- end card body-->
    </div>




</div>
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>