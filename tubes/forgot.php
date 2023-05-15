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




if (isset($_POST['change'])) {
    $error = resetPass($_POST, $_GET['reset']);
}


$date =  date("Y-m-d H:i:s");



// konten
require('views/forgot.view.php');
