<?php
session_start();



// Require AMBIL
require '_backend/functions.php';

// Page Name
$pageName = "Home";

$login = false;

if (isset($_COOKIE['uid'])) {
  $login = cookieOpt($_COOKIE);
  $userDp = cekUser($_SESSION['ids']);
} elseif (isset($_SESSION['login'])) {
  $login = $_SESSION['login'];
  $userDp = cekUser($_SESSION['ids']);
}

// Ambil DATA
$productCategory = query("SELECT id_category, category, img, detail FROM category ORDER BY id_category ASC");

// $products = query("SELECT id_product, product, price, img FROM product ORDER BY RAND() LIMIT 5");
$products = query("SELECT product.product, product.id_product, product.price, product.img, category.category FROM product, category WHERE product.id_category = category.id_category ORDER BY RAND() LIMIT 6");


// konten
require('views/index.view.php');
