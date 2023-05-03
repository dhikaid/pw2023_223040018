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

// kenali 
$jenis = $_POST['jenis'];
$id = $_POST['id'];


if (empty($jenis) || simbolEdit2($jenis) === false || empty($id)) {
  echo '<script>history.back();</script>';
  exit();
}

if (isset($jenis) && isset($id)) {
  if ($_SESSION['ids'] !== $id) {
    if (delete($id, $jenis) > 0) {
      echo "Deleted";
    }
  } else {
    echo "Error";
  }
}
