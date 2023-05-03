<?php
// cek login
session_start();

require 'functions.php';


$idtrans = $_GET['idtrans'];
$idprod = $_GET['prod'];
$ukuran = $_GET['uku'];

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: login");
    exit();
}

if (empty($idtrans) || empty($idprod) || empty($ukuran)) {
    header("Location: ../cart");
    exit();
}

if (isset($idtrans) && isset($idprod)) {
    if (rebuyProduct($_GET, $_SESSION['ids']) > 0) {
        header("Location: ../cart");
        exit();
    } else {
        header("Location: ../cart");
        exit();
    }
}
