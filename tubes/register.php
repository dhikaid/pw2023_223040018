<?php
// cek login
session_start();

if (isset($_SESSION['login']) && isset($_SESSION['ids']) && isset($_SESSION['rls'])) {
  header("Location: dashboard");
  exit();
}

require '_backend/functions.php';
// Page Name
$pageName = "Register";
$error = true;
if (isset($_POST['register'])) {
  $error = register($_POST, NULL);

  if (!$error['error']) {
    echo "<script>
    setTimeout(function() {
        document.location.href='dashboard'
    }, 3000);
    </script>";
  }
}
// konten
require('views/register.view.php');
