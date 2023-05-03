<?php
// cek login
session_start();

require 'functions.php';

$fromid = $_POST['fromid'];
$toid = $_POST['toid'];
$message = $_POST['message'];

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: login");
    exit();
}

if (empty($fromid) || empty($toid) || empty($message)) {
    exit();
}

if (isset($fromid) && isset($toid) && isset($message)) {
    $error = sendMessage($_POST);
}

if (isset($error['error'])) {
    echo $error['code'];
} else {
    echo 0;
}
