<?php
// cek login
session_start();
require '_backend/functions.php';

// cek cookie 
if (isset($_COOKIE['id']) && isset($_COOKIE['uid'])) {
  cookie($_COOKIE);
}

if (isset($_SESSION['login']) && isset($_SESSION['ids']) && isset($_SESSION['rls'])) {
  header("Location: dashboard");
  exit();
}





if (isset($_POST['login'])) {
  $login = login($_POST);
}


// konten
require('views/login.view.php');
