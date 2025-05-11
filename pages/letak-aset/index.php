<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistem Akuntansi</a></li>
                        <li class="breadcrumb-item active">Data Letak Aset</li>
                    </ol>
                </div>
                <h4 class="page-title">Data Letak Aset Terkini</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div id="tabel">

    </div>

    <div id="riwayat-mutasi">

    </div>






</div>
<script>

    function loadTable() {
        $('#tabel').load('pages/letak-aset/tabel-letak-aset.php');
    }

    function loadRiwayatMutasi() {
        $('#riwayat-mutasi').load('pages/letak-aset/tabel-riwayat-mutasi.php');
    }

    $(document).ready(function () {
        loadTable();
        loadRiwayatMutasi();
    });
</script>