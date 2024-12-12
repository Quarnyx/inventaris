<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah':

        $id_aset = $_POST['id_aset'];
        $tanggal_penyusutan = $_POST['tanggal_penyusutan'];
        $nilai_penyusutan = $_POST['nilai_penyusutan'];
        $validasi = "Belum Validasi";

        $sql = $conn->query("INSERT INTO jadwal_penyusutan (id_aset, tanggal_penyusutan, nilai_penyusutan, validasi) VALUES ('$id_aset', '$tanggal_penyusutan', '$nilai_penyusutan', '$validasi')");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'edit':
        $id = $_POST['id'];
        $tanggal_penyusutan = $_POST['tanggal_penyusutan'];
        $sql = $conn->query("UPDATE jadwal_penyusutan SET tanggal_penyusutan = '$tanggal_penyusutan' WHERE id_jadwal = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM jadwal_penyusutan WHERE id_jadwal = '$id'");
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