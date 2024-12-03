<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistem Akuntansi</a></li>
                        <li class="breadcrumb-item active">Data Pengguna</li>
                    </ol>
                </div>
                <h4 class="page-title">Data Pengguna</h4>
            </div>
            <button class="btn btn-primary mb-3" id="tambah-pengguna"><i class="fe-plus"></i> Tambah
                Pengguna</button>

        </div>
    </div>
    <!-- end page title -->
    <div id="tabel-pengguna">

    </div>






</div>
<script>

    function loadTable() {
        $('#tabel-pengguna').load('pages/pengguna/tabel-pengguna.php');
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah-pengguna').click(function () {
            // open modal
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Tambah Pengguna');
            $('#myModal').find('.modal-body').load('pages/pengguna/tambah-pengguna.php');
        })
    })
</script>