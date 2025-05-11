<?php
include '../../config.php';

switch ($_GET['aksi']) {
    case 'tambah':
        $nama_aset = $_POST['nama_aset'];
        $harga_pembelian = preg_replace('/[^0-9]/', '', $_POST['harga_pembelian']);
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
        $umur_ekonomis = $_POST['umur_ekonomis'];
        $nilai_residu = preg_replace('/[^0-9]/', '', $_POST['nilai_residu']);
        $id_kelompok = $_POST['id_kelompok'];
        $id_jenis = $_POST['id_jenis'];
        $deskripsi_aset = $_POST['deskripsi_aset'];
        $jumlah = $_POST['jumlah'];
        $satuan = $_POST['satuan'];
        $status = "Belum Validasi BAST";
        $nilai_penyusutan = preg_replace('/[^0-9]/', '', $_POST['nilai_penyusutan']);
        $nilai_penyusutan = substr($nilai_penyusutan, 0, -2);
        $letak_aset = $_POST['letak_aset'];
        $status_kondisi = $_POST['status_kondisi'];
        $kode_aset = $_POST['kode_aset'];
        $sumber_dana = $_POST['sumber_dana'];
        $merek = $_POST['merek'];
        $klasifikasi_pengadaan = $_POST['klasifikasi_pengadaan'];


        $sql = $conn->query("INSERT INTO aset (nama_aset, harga_pembelian, tanggal_pembelian, umur_ekonomis, nilai_residu, id_kelompok, id_jenis, deskripsi_aset, jumlah, unit, status, nilai_penyusutan, status_kondisi, kode_aset, sumber_dana, merek, klasifikasi_pengadaan) 
        VALUES ('$nama_aset', '$harga_pembelian', '$tanggal_pembelian', '$umur_ekonomis', '$nilai_residu', '$id_kelompok', '$id_jenis', '$deskripsi_aset', '$jumlah', '$satuan', '$status', '$nilai_penyusutan', '$status_kondisi', '$kode_aset', '$sumber_dana', '$merek', '$klasifikasi_pengadaan')");

        // simpan ke tabel letak_aset
        $sql = $conn->query("INSERT INTO letak_aset (id_aset, letak_aset) VALUES (LAST_INSERT_ID(), '$letak_aset')");

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
        $harga_pembelian = preg_replace('/[^0-9]/', '', $_POST['harga_pembelian']);
        $tanggal_pembelian = $_POST['tanggal_pembelian'];
        $umur_ekonomis = $_POST['umur_ekonomis'];
        $nilai_residu = preg_replace('/[^0-9]/', '', $_POST['nilai_residu']);
        $id_kelompok = $_POST['id_kelompok'];
        $id_jenis = $_POST['id_jenis'];
        $deskripsi_aset = $_POST['deskripsi_aset'];
        $jumlah = $_POST['jumlah'];
        $satuan = $_POST['satuan'];
        $nilai_penyusutan = preg_replace('/[^0-9]/', '', $_POST['nilai_penyusutan']);
        $nilai_penyusutan = substr($nilai_penyusutan, 0, -2);
        $sumber_dana = $_POST['sumber_dana'];
        $merek = $_POST['merek'];
        $status_kondisi = $_POST['status_kondisi'];
        $klasifikasi_pengadaan = $_POST['klasifikasi_pengadaan'];

        $sql = $conn->query("UPDATE aset SET 
        nama_aset = '$nama_aset', 
        harga_pembelian = '$harga_pembelian', 
        tanggal_pembelian = '$tanggal_pembelian', 
        umur_ekonomis = '$umur_ekonomis', 
        nilai_residu = '$nilai_residu', 
        id_kelompok = '$id_kelompok', 
        id_jenis = '$id_jenis', 
        deskripsi_aset = '$deskripsi_aset', 
        jumlah = '$jumlah', 
        unit = '$satuan', 
        nilai_penyusutan = '$nilai_penyusutan', 
        sumber_dana = '$sumber_dana', 
        merek = '$merek', 
        status_kondisi = '$status_kondisi', 
        klasifikasi_pengadaan = '$klasifikasi_pengadaan' 
        WHERE id_aset = '$id'");
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
    case 'ajukan-perbaikan':
        $id = $_POST['id'];
        $keterangan_tolak = $_POST['keterangan_tolak'];
        $sql = $conn->query("UPDATE aset SET status = 'Perbaikan', keterangan_tolak = '$keterangan_tolak' WHERE id_aset = '$id'");
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