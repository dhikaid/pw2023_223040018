<?php
require('functions.php');

$name = 'Tambah Data Mahasiswa';

// Ketika submit di klik
if (isset($_POST['tambah'])) {
    // Jalankan fungsi tambah
    if (tambah($_POST) > 0) {
        echo "<script>alert('Data berhasil ditambahkan');
        document.location.href='index.php';
        </script>";
    }
}

require('views/tambah.view.php');
