<?php

session_start();

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
$id = $_GET['id'];

if (empty($jenis) || simbolEdit2($jenis) === false || empty($id) || simbolEdit2($jenis) === "USER") {
  echo '<script>history.back();</script>';
  exit();
}

// ambil data
$error = false;
$page = 1;
$formRating = false;
if (isset($_GET['page']) && !empty($_GET['page'])) {
  $page = $_GET['page'];
}
if ($jenis === "prod") {
  if (!$product = query("SELECT product.product, product.detail, product.price, product.img, category.category, product.id_product, ukuran.* FROM product, category,ukuran WHERE id_product = $id AND product.id_ukuran = ukuran.id_ukuran AND product.id_category = category.id_category ")[0]) {
    $error = true;
  } else {
    $productsRand = query("SELECT product.product, product.id_product, product.price, product.img, category.category FROM product, category WHERE product.id_category = category.id_category AND product.id_product != $id ORDER BY RAND() LIMIT 6");

    // rating

    $ratings = ratingProduct($id);




    // invoice

    if (isset($_GET['invoice'])) {
      $invoice = $_GET['invoice'];
      if (query("SELECT transaksi.id_transaksi, product.id_product FROM transaksi, transaksi_detail, users, pembayaran, product WHERE users.id_users = transaksi.id_users AND transaksi.id_transaksi = transaksi_detail.id_transaksi AND transaksi_detail.id_product = product.id_product AND transaksi.id_transaksi = pembayaran.id_transaksi AND pembayaran.transaction_status = 'paid' AND transaksi.id_transaksi = '$invoice' AND transaksi.id_users = '$userDp[id_users]' AND product.id_product = '$id'")) {
        if (!query("SELECT feedback.* FROM feedback, transaksi, product WHERE transaksi.id_transaksi = feedback.id_transaksi AND feedback.id_product = product.id_product AND transaksi.id_transaksi = '$invoice' AND product.id_product = '$id'")) {
          $formRating = true;
        }
      }
    }
  }
} elseif ($jenis === "categ") {
  if (!$category = query("SELECT img, detail, category FROM category WHERE id_category = $id ")[0]) {
    $error = true;
  } else {

    // page
    $queryPagi = "SELECT product.product, product.id_product, product.price, product.img, category.category FROM product, category WHERE category.id_category = $id AND product.id_category = category.id_category";
    $paginationCateg = pagination($queryPagi, 6, $page);
    $pcategories = query($paginationCateg['query']);
  }
}

// header category
$headerCateg = query("SELECT category, id_category FROM category");


// konten
require('views/detail.view.php');
