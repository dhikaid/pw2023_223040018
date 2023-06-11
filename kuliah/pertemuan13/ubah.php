<?php
require('functions.php');

$name = 'Ubah Data Mahasiswa';
$id = $_GET['id'];
$student = query("SELECT * FROM mahasiswa WHERE id=$id")[0];
// Ketika submit di klik
if (isset($_POST["ubah"])) {
    // Jalankan fungsi tambah
    if (ubah($_POST) > 0) {
        echo "<script>alert('Data berhasil diubah');
        document.location.href='index.php';
        </script>";
    }
}

require('views/ubah.view.php');
