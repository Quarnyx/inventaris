<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah':
        $nama_aset = $_POST['nama_aset'];
        $harga_pembelian = $_POST['harga_pembelian'];
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
        $umur_ekonomis = $_POST['umur_ekonomis'];
        $nilai_residu = $_POST['nilai_residu'];
        $id_kelompok = $_POST['id_kelompok'];
        $id_jenis = $_POST['id_jenis'];
        $deskripsi_aset = $_POST['deskripsi_aset'];
        $jumlah = $_POST['jumlah'];
        $satuan = $_POST['satuan'];
        $status = "Belum Validasi BAST";

        $sql = $conn->query("INSERT INTO aset (nama_aset, harga_pembelian, tanggal_pembelian, umur_ekonomis, nilai_residu, id_kelompok, id_jenis, deskripsi_aset, jumlah, unit, status) 
        VALUES ('$nama_aset', '$harga_pembelian', '$tanggal_pembelian', '$umur_ekonomis', '$nilai_residu', '$id_kelompok', '$id_jenis', '$deskripsi_aset', '$jumlah', '$satuan', '$status')");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'edit':
        $id = $_POST['id'];
        $nama_aset = $_POST['nama_aset'];
        $harga_pembelian = $_POST['harga_pembelian'];
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
        $umur_ekonomis = $_POST['umur_ekonomis'];
        $nilai_residu = $_POST['nilai_residu'];
        $id_kelompok = $_POST['id_kelompok'];
        $id_jenis = $_POST['id_jenis'];
        $deskripsi_aset = $_POST['deskripsi_aset'];
        $jumlah = $_POST['jumlah'];
        $satuan = $_POST['satuan'];

        $sql = $conn->query("UPDATE aset SET nama_aset = '$nama_aset', harga_pembelian = '$harga_pembelian', tanggal_pembelian = '$tanggal_pembelian', umur_ekonomis = '$umur_ekonomis', nilai_residu = '$nilai_residu', id_kelompok = '$id_kelompok', id_jenis = '$id_jenis', deskripsi_aset = '$deskripsi_aset', jumlah = '$jumlah', unit = '$satuan' WHERE id_aset = '$id'");
        if ($sql) {
            echo "ok";
        } else {
            echo "gagal";
            echo $conn->error;
        }
        break;
    case 'hapus':
        $id = $_POST['id'];
        $sql = $conn->query("DELETE FROM aset WHERE id_aset = '$id'");
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