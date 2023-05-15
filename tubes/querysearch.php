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



if (!isset($_GET) || empty($_GET['keyword']) || empty($_GET['page']) || !is_numeric($_GET['page'])) {
    echo '<script>history.back();</script>';
    exit();
}


$keyword = $_GET['keyword'];
$page = $_GET['page'];

$searchKeyword = search($_GET, 'prod');
$keywords = $searchKeyword['query'];


// header category
$headerCateg = query("SELECT category, id_category FROM category");


// konten
require('views/querysearch.view.php');
