<div class="row">
    <div class="col-12">
        <div class="card-box table-responsive">
            <h4 class="header-title"><b>Tabel Data Pemindahtanganan Aset</b></h4>

            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Aset</th>
                        <th>Tanggal Pemindahtanganan</th>
                        <th>Metode</th>
                        <th>Pihak Penerima</th>
                        <th>Dokumen Pendukung</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    include '../../config.php';
                    $no = 1;
                    $sql = $conn->query("SELECT p.*, a.nama_aset 
                                       FROM pemindahtanganan_aset p 
                                       JOIN aset a ON p.id_aset = a.id_aset");
                    while ($data = $sql->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $data['nama_aset']; ?></td>
                            <td><?php echo date('d-m-Y', strtotime($data['tanggal_pemindahtanganan'])); ?></td>
                            <td><?php echo $data['metode']; ?></td>
                            <td><?php echo $data['pihak_penerima']; ?></td>
                            <td><a href="pages/pemindahtanganan-aset/dokumen_pendukung/<?php echo $data['dokumen_pendukung']; ?>"
                                    target="_blank"><?php echo $data['dokumen_pendukung']; ?></a></td>
                            <td><?php echo $data['keterangan']; ?></td>
                            <td>
                                <button data-id="<?php echo $data['id_pemindahtanganan']; ?>" id="edit"
                                    class="btn btn-warning btn-sm"><i class="fe-edit"></i></button>
                                <button data-id="<?php echo $data['id_pemindahtanganan']; ?>" id="delete"
                                    class="btn btn-danger btn-sm"><i class="fe-trash"></i></button>
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
        $('#datatable').DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>"
                }
            },
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
            }
        });

        // Edit button click
        $(document).on('click', '#edit', function () {
            var id = $(this).data('id');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Edit Pemindahtanganan Aset');
            $('#myModal').find('.modal-body').load('pages/pemindahtanganan-aset/edit-pemindahtanganan-aset.php?id=' + id);
        });

        // Delete button click
        $(document).on('click', '#delete', function () {
            var id = $(this).data('id');
            alertify.confirm('Konfirmasi', 'Apakah Anda yakin ingin menghapus data ini?',
                function () {
                    $.ajax({
                        url: 'pages/pemindahtanganan-aset/proses-pemindahtanganan-aset.php',
                        type: 'POST',
                        data: { id: id, act: 'hapus' },
                        success: function (response) {
                            if (response == 'success') {
                                loadTable();
                                alertify.success('Data berhasil dihapus');
                            } else {
                                alertify.error('Data gagal dihapus');
                            }
                        }
                    });
                },
                function () {
                    alertify.error('Batal menghapus data');
                }
            );
        });
    });
</script>