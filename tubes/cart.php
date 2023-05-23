<?php

// cek login
session_start();

// Require AMBIL
require '_backend/functions.php';

// Page Name
$pageName = 'Cart';

$login = false;

if (isset($_COOKIE['uid'])) {
    $login = cookieOpt($_COOKIE);
    $userDp = cekUser($_SESSION['ids']);
} elseif (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $userDp = cekUser($_SESSION['ids']);
}

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: login");
    exit();
}



// ambil data
$transaksi = query("SELECT transaksi_detail.id_transaksi, product.price as pprice, transaksi_detail.price as tpice, transaksi_detail.qty , transaksi_detail.ukuran, product.product, product.img, product.id_product FROM transaksi, transaksi_detail, product, pembayaran WHERE product.id_product = transaksi_detail.id_product AND transaksi_detail.id_transaksi = transaksi.id_transaksi AND transaksi.id_users = '$userDp[id_users]' AND transaksi.id_transaksi = pembayaran.id_transaksi AND pembayaran.status_code = 0  ");


// header category
$headerCateg = query("SELECT category, id_category FROM category");

// konten
require('views/cart.view.php');
