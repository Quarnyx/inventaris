<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sistem Akuntansi</a></li>
                        <li class="breadcrumb-item active">Penyusutan Aset</li>
                    </ol>
                </div>
                <h4 class="page-title">Data Penyusutan Aset</h4>
            </div>
            <button class="btn btn-primary mb-3" id="tambah"><i class="fe-plus"></i> Ajukan Penyusutan Aset</button>

        </div>
    </div>
    <!-- end page title -->
    <div id="tabel">

    </div>






</div>
<script>

    function loadTable() {
        $('#tabel').load('pages/daftar-penyusutan/tabel-penyusutan-aset.php');
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').click(function () {
            // open modal
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Ajukan Penyusutan Aset');
            $('#myModal').find('.modal-body').load('pages/daftar-penyusutan/tambah-penyusutan.php');
        })
    })
</script>