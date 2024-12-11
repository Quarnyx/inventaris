<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistem Akuntansi</a></li>
                        <li class="breadcrumb-item active">Data Validasi Aset</li>
                    </ol>
                </div>
                <h4 class="page-title">Data Validasi Aset</h4>
            </div>

        </div>
    </div>
    <!-- end page title -->
    <div id="tabel">

    </div>






</div>
<script>


    function loadTable() {
        $('#tabel').load('pages/validasi/tabel-validasi.php?act=<?php echo $_GET['act']; ?>');
    }
    $(document).ready(function () {
        loadTable();
    })
</script>