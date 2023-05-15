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
$id = $_GET['id'];

if (empty($jenis) || simbolEdit2($jenis) === false || empty($id)) {
  echo '<script>history.back();</script>';
  exit();
}



// Ambil DATA
$alert = 0;
$error = false;
if ($jenis === "prod") {

  if (!$products = query("SELECT * FROM product WHERE id_product = '$id'")) {
    $error = true;
  } else {
    $products = $products[0];
    $ukurans = query("SELECT * from ukuran");
  }
  $category = query("SELECT id_category, category FROM category");
} elseif ($jenis === "user") {
  if (!$user = query("SELECT *, users.id_role AS urole FROM users, roles WHERE users.id_users = '$id'  AND users.id_role = roles.id_role ")) {
    $error = true;
  } else {
    $user = $user[0];
  }


  $roles = query("SELECT * FROM roles");
} elseif ($jenis === "categ") {
  if (!$category = query("SELECT * FROM category WHERE id_category = '$id'")) {
    $error = true;
  } else {
    $category = $category[0];
  }
}



// kirim data
if (isset($_POST['create'])) {

  $edit = edit($_POST, $jenis, $id);
  if (!$edit['error']) {
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
require('views/edit.view.php');
