<?php
// cek login
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
  header("Location: login");
  exit();
}


if ($_SESSION['rls'] !== "a") {
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

// Ambil DATA
$products = query("SELECT id_product, img, product, price FROM product");
$categories = query("SELECT id_category, img, category FROM category");
$users = query("SELECT users.id_users, users.username, users.img , roles.jenis FROM users, roles WHERE users.id_role = roles.id_role");
$myuser = query("SELECT * FROM users WHERE id_users = '$_SESSION[ids]'")[0];

$alert = 0;
// kirim data
if (isset($_POST['create'])) {
  // var_dump($_POST);
  // die;
  $editProfile = edit($_POST, 'user', $_SESSION['ids']);
  if (!$editProfile['error']) {
    echo "<script>
    setTimeout(function() {
        document.location.href='dashboard'
    }, 3000);
    </script>";
  }
}




// header category
$headerCateg = query("SELECT category, id_category FROM category");


// transaksi
$purchases = query("SELECT transaksi.id_transaksi, transaksi.tanggal,  pembayaran.payment_method, pembayaran.payment_code, pembayaran.transaction_status, pembayaran.status_code FROM transaksi, pembayaran WHERE transaksi.id_transaksi = pembayaran.id_transaksi AND pembayaran.status_code != 0 AND transaksi.id_users = '$myuser[id_users]' ORDER BY transaksi.tanggal DESC");


// konten
require('views/dashboard.view.php');
