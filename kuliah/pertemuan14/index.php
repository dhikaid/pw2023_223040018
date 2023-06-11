<?php
require('functions.php');

$name = 'Home';

// cari siswa berdasarkan keyword ketika tombol ditekan

if (isset($_GET['search'])) {
    $keyword = $_GET['keyword'];
    $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$keyword%' OR jurusan LIKE '%$keyword%' OR email LIKE '%$keyword%' OR nim LIKE '%$keyword%'";
    $students = query($query);
} else {
    $students = query("SELECT * FROM mahasiswa");
}


require('views/index.view.php');
