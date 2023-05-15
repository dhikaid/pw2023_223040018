<?php
// cek login
session_start();
// Require AMBIL
require 'functions.php';

// kenali 
$prev = $_POST['ppass'];
$new = $_POST['npass'];
$id = $_POST['ids'];


if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: ../login");
    exit();
}

if ($_SESSION['ids'] !== $id) {
    echo "Don't Do THAT!";
    exit();
}


if (empty($prev) || empty($new) || empty($id)) {
    echo '<script>history.back();</script>';
    exit();
}

if (isset($prev) && isset($new) && isset($id)) {
    $error = changePass($_POST);
}

if (isset($error['error'])) {
    echo $error['code'];
} else {
    echo 0;
}
