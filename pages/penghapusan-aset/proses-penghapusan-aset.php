<?php
include '../../config.php';

$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $id_aset = $_POST['id_aset'];
    $tanggal_penghapusan = $_POST['tanggal_penghapusan'];
    $alasan = $_POST['alasan'];
    $metode_penghapusan = $_POST['metode_penghapusan'];

    // Handle file upload
    $dokumen_pendukung = '';
    if (isset($_FILES['dokumen_pendukung']) && $_FILES['dokumen_pendukung']['error'] == 0) {
        $allowed = array('pdf', 'jpg', 'jpeg', 'png');
        $filename = $_FILES['dokumen_pendukung']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $new_filename = time() . '_' . $filename;
            $upload_path = '../../pages/penghapusan-aset/dokumen/' . $new_filename;

            if (move_uploaded_file($_FILES['dokumen_pendukung']['tmp_name'], $upload_path)) {
                $dokumen_pendukung = $new_filename;
            }
        }
    }

    $sql = $conn->query("INSERT INTO penghapusan_aset (id_aset, tanggal_penghapusan, alasan, metode_penghapusan, dokumen_pendukung) 
                        VALUES ('$id_aset', '$tanggal_penghapusan', '$alasan', '$metode_penghapusan', '$dokumen_pendukung')");

    if ($sql) {
        echo "ok";
    } else {
        echo "error";
    }
} else if ($aksi == 'edit') {
    $id_penghapusan = $_POST['id_penghapusan'];
    $id_aset = $_POST['id_aset'];
    $tanggal_penghapusan = $_POST['tanggal_penghapusan'];
    $alasan = $_POST['alasan'];
    $metode_penghapusan = $_POST['metode_penghapusan'];
    $dokumen_lama = $_POST['dokumen_lama'];

    // Handle file upload
    $dokumen_pendukung = $dokumen_lama;
    if (isset($_FILES['dokumen_pendukung']) && $_FILES['dokumen_pendukung']['error'] == 0) {
        $allowed = array('pdf', 'jpg', 'jpeg', 'png');
        $filename = $_FILES['dokumen_pendukung']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $new_filename = time() . '_' . $filename;
            $upload_path = '../../pages/penghapusan-aset/dokumen/' . $new_filename;

            if (move_uploaded_file($_FILES['dokumen_pendukung']['tmp_name'], $upload_path)) {
                // Delete old file if exists
                if ($dokumen_lama && file_exists('../../pages/penghapusan-aset/dokumen/' . $dokumen_lama)) {
                    unlink('../../pages/penghapusan-aset/dokumen/' . $dokumen_lama);
                }
                $dokumen_pendukung = $new_filename;
            }
        }
    }

    $sql = $conn->query("UPDATE penghapusan_aset SET 
                        id_aset = '$id_aset',
                        tanggal_penghapusan = '$tanggal_penghapusan',
                        alasan = '$alasan',
                        metode_penghapusan = '$metode_penghapusan',
                        dokumen_pendukung = '$dokumen_pendukung'
                        WHERE id_penghapusan = '$id_penghapusan'");

    if ($sql) {
        echo "ok";
    } else {
        echo "error";
    }
} else if ($aksi == 'hapus') {
    $id = $_POST['id'];

    // Get document filename before deleting
    $sql_get = $conn->query("SELECT dokumen_pendukung FROM penghapusan_aset WHERE id_penghapusan = '$id'");
    $data = $sql_get->fetch_assoc();

    // Delete the record
    $sql = $conn->query("DELETE FROM penghapusan_aset WHERE id_penghapusan = '$id'");

    if ($sql) {
        // Delete the document file if exists
        if ($data['dokumen_pendukung'] && file_exists('../../pages/penghapusan-aset/dokumen/' . $data['dokumen_pendukung'])) {
            unlink('../../pages/penghapusan-aset/dokumen/' . $data['dokumen_pendukung']);
        }
        echo "ok";
    } else {
        echo "error";
    }
}
?>