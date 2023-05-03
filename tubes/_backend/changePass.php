<?php
// Require AMBIL
require 'functions.php';

// kenali 
$prev = $_POST['ppass'];
$new = $_POST['npass'];
$id = $_POST['ids'];


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
