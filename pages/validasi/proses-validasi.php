<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah-validasi':
        $keterangan_validasi = $_POST['keterangan_validasi'];
        $bukti_dokumen = $_FILES['bukti_dokumen']['name'];
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["bukti_dokumen"]["name"]);
        move_uploaded_file($_FILES["bukti_dokumen"]["tmp_name"], $target_file);
        $id_aset = $_POST['id'];
        $status_validasi = 'Sudah Validasi Tambah Aset';

        $sql = $conn->query("INSERT INTO validasi (keterangan_validasi, bukti_dokumen, id_aset, status_validasi) VALUES ('$keterangan_validasi', '$bukti_dokumen', '$id_aset', '$status_validasi')");

        // update aset data
        $sql = $conn->query("UPDATE aset SET status = 'Sudah Validasi Tambah Aset' WHERE id_aset = '$id_aset'");

        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'edit-validasi':
        $id = $_POST['id'];
        $id_validasi = $_POST['id_validasi'];
        $bukti_dokumen = $_FILES['bukti_dokumen']['name'];
        $bukti_dokumen_lama = $_POST['bukti_dokumen_lama'];
        $keterangan_validasi = $_POST['keterangan_validasi'];
        if ($bukti_dokumen != '') {
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["bukti_dokumen"]["name"]);
            move_uploaded_file($_FILES["bukti_dokumen"]["tmp_name"], $target_file);
            $sql = $conn->query("UPDATE validasi SET bukti_dokumen = '$bukti_dokumen', keterangan_validasi = '$keterangan_validasi' WHERE id_validasi = '$id_validasi'");
        } else {
            $sql = $conn->query("UPDATE validasi SET bukti_dokumen = '$bukti_dokumen_lama', keterangan_validasi = '$keterangan_validasi' WHERE id_validasi = '$id_validasi'");
        }
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM validasi WHERE id_validasi = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    default:
        $aksi = 'tambah';
        break;
}