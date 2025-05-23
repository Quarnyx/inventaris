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
                        <th>Kelompok Aset</th>
                        <th>Letak Aset</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>


                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT
                        kelompok_aset.nama_kelompok, 
                        aset.nama_aset, 
                        aset.id_aset, 
                        letak_aset.id_letak,
                        letak_aset.letak_aset, 
                        letak_aset.keterangan
                    FROM
                        aset
                        INNER JOIN
                        kelompok_aset
                        ON 
                            aset.id_kelompok = kelompok_aset.id_kelompok
                        INNER JOIN
                        letak_aset
                        ON 
                            aset.id_aset = letak_aset.id_aset");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $no++; ?>
                            </td>
                            <td>
                                <?php echo $data['nama_aset']; ?>
                            </td>
                            <td><?php echo $data['nama_kelompok']; ?></td>
                            <td><?php echo $data['letak_aset']; ?></td>
                            <td><?php echo $data['keterangan']; ?></td>
                            <td>
                                <button data-id="<?php echo $data['id_letak']; ?>" id="mutasi-aset"
                                    data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-info btn-sm"><i
                                        class="fe-move"></i> Mutasi Aset</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div> <!-- end row -->
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
        $('#datatable').on('click', '#mutasi-aset', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            $.ajax({
                type: 'POST',
                url: 'pages/letak-aset/mutasi-aset.php',
                data: 'id=' + id + '&nama=' + nama,
                success: function (data) {
                    $('#myModal').modal('show');
                    $('.modal-title').html('Mutasi Aset ' + nama);
                    $('.modal .modal-body').html(data);
                }
            })
        });
        $('#datatable').on('click', '#delete', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data ' + nama + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/letak-aset/proses-letak-aset.php?aksi=hapus',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            alertify.success('Letak Aset Berhasil Dihapus');

                        } else {
                            alertify.error('Letak Aset Gagal Dihapus');

                        }
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Hapus dibatalkan');
            })
        });
    });
</script>