<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistem Akuntansi</a></li>
                        <li class="breadcrumb-item active">Data Kelompok Aset</li>
                    </ol>
                </div>
                <h4 class="page-title">Data Kelompok Aset</h4>
            </div>
            <button class="btn btn-primary mb-3" id="tambah"><i class="fe-plus"></i> Tambah
                Kelompok Aset</button>

        </div>
    </div>
    <!-- end page title -->
    <div id="tabel">

    </div>






</div>
<script>

    function loadTable() {
        $('#tabel').load('pages/kelompok-aset/tabel-kelompok-aset.php');
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').click(function () {
            // open modal
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Tambah Kelompok Aset');
            $('#myModal').find('.modal-body').load('pages/kelompok-aset/tambah-kelompok-aset.php');
        })
    })
</script>