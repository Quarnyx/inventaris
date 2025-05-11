<?php
include '../../config.php';

$act = $_POST['act'];

switch ($act) {
    case 'tambah':
        $id_aset = $_POST['id_aset'];
        $tanggal_pemindahtanganan = $_POST['tanggal_pemindahtanganan'];
        $metode = $_POST['metode'];
        $pihak_penerima = $_POST['pihak_penerima'];
        $keterangan = $_POST['keterangan'];

        // Handle file upload
        $dokumen_pendukung = '';
        if (isset($_FILES['dokumen_pendukung']) && $_FILES['dokumen_pendukung']['error'] == 0) {
            $allowed = array('pdf', 'doc', 'docx');
            $filename = $_FILES['dokumen_pendukung']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($ext, $allowed)) {
                $new_filename = time() . '_' . $filename;
                $upload_path = '../../pages/pemindahtanganan-aset/dokumen_pendukung/';

                // Create directory if it doesn't exist
                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                if (move_uploaded_file($_FILES['dokumen_pendukung']['tmp_name'], $upload_path . $new_filename)) {
                    $dokumen_pendukung = $new_filename;
                }
            }
        }

        $query = $conn->query("INSERT INTO pemindahtanganan_aset (id_aset, tanggal_pemindahtanganan, metode, pihak_penerima, dokumen_pendukung, keterangan) VALUES ('$id_aset', '$tanggal_pemindahtanganan', '$metode', '$pihak_penerima', '$dokumen_pendukung', '$keterangan')");

        if ($query) {
            // Update status aset
            $conn->query("UPDATE aset SET status = 'Pemindahtanganan' WHERE id_aset = '$id_aset'");
            echo 'success';
        } else {
            echo 'error';
        }
        break;

    case 'edit':
        $id_pemindahtanganan = $_POST['id_pemindahtanganan'];
        $id_aset = $_POST['id_aset'];
        $tanggal_pemindahtanganan = $_POST['tanggal_pemindahtanganan'];
        $metode = $_POST['metode'];
        $pihak_penerima = $_POST['pihak_penerima'];
        $keterangan = $_POST['keterangan'];

        // Get old data
        $old_data = $conn->query("SELECT id_aset, dokumen_pendukung FROM pemindahtanganan_aset WHERE id_pemindahtanganan = '$id_pemindahtanganan'")->fetch_assoc();
        $old_id_aset = $old_data['id_aset'];
        $old_dokumen = $old_data['dokumen_pendukung'];

        // Handle file upload
        $dokumen_pendukung = $old_dokumen;
        if (isset($_FILES['dokumen_pendukung']) && $_FILES['dokumen_pendukung']['error'] == 0) {
            $allowed = array('pdf', 'doc', 'docx');
            $filename = $_FILES['dokumen_pendukung']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (in_array($ext, $allowed)) {
                $new_filename = time() . '_' . $filename;
                $upload_path = '../../pages/pemindahtanganan-aset/dokumen_pendukung/';

                // Create directory if it doesn't exist
                if (!file_exists($upload_path)) {
                    mkdir($upload_path, 0777, true);
                }

                if (move_uploaded_file($_FILES['dokumen_pendukung']['tmp_name'], $upload_path . $new_filename)) {
                    // Delete old file if exists
                    if ($old_dokumen && file_exists($upload_path . $old_dokumen)) {
                        unlink($upload_path . $old_dokumen);
                    }
                    $dokumen_pendukung = $new_filename;
                }
            }
        }

        $query = $conn->query("UPDATE pemindahtanganan_aset SET id_aset = '$id_aset', tanggal_pemindahtanganan = '$tanggal_pemindahtanganan', metode = '$metode', pihak_penerima = '$pihak_penerima', dokumen_pendukung = '$dokumen_pendukung', keterangan = '$keterangan' WHERE id_pemindahtanganan = '$id_pemindahtanganan'");

        if ($query) {
            // Update status aset if id_aset changed
            if ($old_id_aset != $id_aset) {
                $conn->query("UPDATE aset SET status = 'Sudah Validasi Tambah Aset' WHERE id_aset = '$old_id_aset'");
                $conn->query("UPDATE aset SET status = 'Pemindahtanganan' WHERE id_aset = '$id_aset'");
            }
            echo 'success';
        } else {
            echo 'error';
        }
        break;

    case 'hapus':
        $id_pemindahtanganan = $_POST['id'];

        // Get data before delete
        $data = $conn->query("SELECT id_aset, dokumen_pendukung FROM pemindahtanganan_aset WHERE id_pemindahtanganan = '$id_pemindahtanganan'")->fetch_assoc();
        $id_aset = $data['id_aset'];
        $dokumen = $data['dokumen_pendukung'];

        $query = $conn->query("DELETE FROM pemindahtanganan_aset WHERE id_pemindahtanganan = '$id_pemindahtanganan'");

        if ($query) {
            // Update status aset
            $conn->query("UPDATE aset SET status = 'Sudah Validasi Pemindahtanganan Aset' WHERE id_aset = '$id_aset'");

            // Delete dokumen file if exists
            if ($dokumen) {
                $file_path = '../../pages/pemindahtanganan-aset/dokumen_pendukung/' . $dokumen;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }

            echo 'success';
        } else {
            echo 'error';
        }
        break;
}
?>