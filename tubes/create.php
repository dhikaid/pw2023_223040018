<?php
// cek login
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: login");
    exit();
} elseif ($_SESSION['rls'] !== "a") {
    header("Location: profile");
    exit();
}

// Require AMBIL
require '_backend/functions.php';

$login = false;

if (isset($_COOKIE['uid'])) {
    $login = cookieOpt($_COOKIE);
    $userDp = cekUser($_SESSION['ids']);
} elseif (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $userDp = cekUser($_SESSION['ids']);
}

// kenali 
$jenis = $_GET['jen'];

if (empty($jenis) || simbolEdit2($jenis) === false) {
    echo '<script>history.back();</script>';
    exit();
}



// Ambil DATA
$alert = false;
if ($jenis === "prod") {
    $category = query("SELECT id_category, category FROM category");
    // Ukuran
    $ukurans = query("SELECT * from ukuran");
} elseif ($jenis === "user") {
} elseif ($jenis === "categ") {
}


// kirim data
if (isset($_POST['create'])) {
    $create =  create($_POST, $jenis);

    if (!$create['error']) {
        echo "<script>
    setTimeout(function() {
        document.location.href='dashboard'
    }, 3000);
    </script>";
    }
}

// header category
$headerCateg = query("SELECT category, id_category FROM category");

// konten
require('views/create.view.php');
