<?php
// cek login
session_start();

require 'functions.php';

$product = $_POST['product'];
$qty = $_POST['qty'];
$iduser = $_POST['iduser'];
$ukuran = $_POST['ukuran'];



if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: login");
    exit();
}

if (empty($product) || empty($qty) || empty($iduser) || empty($ukuran) || $qty <= 0) {
    echo '1';
    exit();
}

if (isset($product) && isset($qty) && isset($iduser) && isset($ukuran)) {
    if (buyProduct($_POST) > 0) {
        echo '0';
    } else {
        echo '1';
    }
}
