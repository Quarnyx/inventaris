<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Tabel Data Penghapusan Aset</b></h4>

            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Aset</th>
                        <th>Tanggal Penghapusan</th>
                        <th>Alasan</th>
                        <th>Metode Penghapusan</th>
                        <th>Dokumen Pendukung</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT 
                        penghapusan_aset.*,
                        aset.nama_aset
                    FROM 
                        penghapusan_aset
                    INNER JOIN 
                        aset ON penghapusan_aset.id_aset = aset.id_aset");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_aset']; ?></td>
                            <td><?php echo $data['tanggal_penghapusan']; ?></td>
                            <td><?php echo $data['alasan']; ?></td>
                            <td><?php echo $data['metode_penghapusan']; ?></td>
                            <td>
                                <?php if ($data['dokumen_pendukung']) { ?>
                                    <a href="../../pages/penghapusan-aset/dokumen/<?php echo $data['dokumen_pendukung']; ?>"
                                        target="_blank" class="btn btn-info btn-sm">
                                        <i class="fe-file-text"></i> Lihat Dokumen
                                    </a>
                                <?php } else { ?>
                                    <span class="text-muted">Tidak ada dokumen</span>
                                <?php } ?>
                            </td>
                            <td>
                                <button data-id="<?php echo $data['id_penghapusan']; ?>" id="edit"
                                    data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-warning btn-sm"><i
                                        class="fe-edit"></i></button>
                                <button data-id="<?php echo $data['id_penghapusan']; ?>" id="delete"
                                    data-nama="<?php echo $data['nama_aset']; ?>" class="btn btn-danger btn-sm"><i
                                        class="fe-trash"></i></button>
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
        $('#datatable').on('click', '#edit', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            $.ajax({
                type: 'POST',
                url: 'pages/penghapusan-aset/edit-penghapusan-aset.php',
                data: 'id=' + id + '&nama=' + nama,
                success: function (data) {
                    $('#myModal').modal('show');
                    $('.modal-title').html('Edit Data ' + nama);
                    $('.modal .modal-body').html(data);
                }
            })
        });
        $('#datatable').on('click', '#delete', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data penghapusan aset ' + nama + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'pages/penghapusan-aset/proses-penghapusan-aset.php?aksi=hapus',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            alertify.success('Data Penghapusan Aset Berhasil Dihapus');
                        } else {
                            alertify.error('Data Penghapusan Aset Gagal Dihapus');
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