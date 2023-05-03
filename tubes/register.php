<?php
// cek login
session_start();

if (isset($_SESSION['login']) && isset($_SESSION['ids']) && isset($_SESSION['rls'])) {
  header("Location: dashboard");
  exit();
}

require '_backend/functions.php';

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
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Nike | Just Do It.</title>
  <!-- BS LOKAL -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <!-- CSS CUS -->
  <link rel="stylesheet" href="css/custom.css" />

  <!-- BS ICO -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

  <!-- GOOGLE FONT -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;600;700&display=swap" rel="stylesheet">

</head>

<body class="text-light-opt">
  <section class="login-area">
    <div class="card bg-dark position-absolute top-50 start-50 translate-middle w-50 p-3 rounded login-area-card">
      <div class="m-auto">
        <img src="img/nav-logo.png" width="50" alt="" />
      </div>
      <p class="text-center fs-5">Welcome to Nike!</p>
      <p class="text-center">Please register your account.</p>
      <form action="" method="post">
        <div class="card-body">
          <?php if (isset($error['error']) && $error['error']) : ?>
            <div class="pt-2">
              <div class="alert bg-danger alert-dismissible fade show bg-dark" role="alert">
                <strong>GAGAL!</strong> <?= $error['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          <?php endif; ?>
          <?php if (isset($error['error']) && !$error['error']) : ?>
            <div class="pt-2">
              <div class="alert bg-success alert-dismissible fade show" role="alert">
                <strong>BERHASIL!</strong> <?= $error['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            </div>
          <?php endif; ?>
          <div class="form-floating mb-3">
            <input type="text" class="form-control bg-dark text-light usernameInput" id="floatingInput" placeholder="name@example.com" name="nama" required autocomplete="off" autofocus />
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control bg-dark text-light" id="floatingInput" placeholder="name@example.com" required autocomplete="off" />
            <label for="floatingInput">Email address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control bg-dark text-light" id="floatingPassword" placeholder="Password" name="password1" required />
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control bg-dark text-light" id="floatingPassword" placeholder="Password" name="password2" required />
            <label for="floatingPassword">Confrim Password</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control bg-dark text-light" id="floatingInput" placeholder="JL. Washington DC" name="address" required />
            <label for="floatingInput">Address</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" class="form-control bg-dark text-light" id="floatingInput" placeholder="17/08/1945" name="date" required />
            <label for="floatingInput">Date of Birth</label>
          </div>
          <div class="mt-3">
            <button type="submit" name="register" class="btn btn-outline-light">
              Register
            </button> | <a href="login">Login</a>
          </div>
        </div>
      </form>
    </div>
  </section>
  <!-- footer -->

  <footer class="bg-black p-4">
    <div class="container">
      <div class="fs-5">
        <a href="" class="me-3"> <i class="bi bi-twitter"></i></a>
        <a href="" class="me-3"> <i class="bi bi-youtube"></i></a>
        <a href="" class="me-3"> <i class="bi bi-instagram"></i></a>
      </div>

      <div class="row pt-2">
        <div class="col">
          <p><i class="bi bi-c-circle"></i> Nike, Inc. All Rights Reserved</p>
        </div>
      </div>
    </div>
  </footer>
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/custom.js"></script>
  <script>
    removeSpace();
  </script>
</body>

</html>