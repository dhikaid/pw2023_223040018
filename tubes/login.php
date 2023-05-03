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
      <p class="text-center fs-5">Login to Your Account.</p>
      <form action="" method="post">
        <div class="card-body">
          <?php if (isset($login['error'])) : ?>
            <div class="alert bg-danger alert-dismissible fade show" role="alert">
              <?= $login['message']; ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>
          <div class="form-floating mb-3">
            <input type="text" name="username" class="form-control bg-dark text-light usernameInput" id="floatingInput" placeholder="name@example.com" required autofocus autocomplete="off" />
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" class="form-control bg-dark text-light" id="floatingPassword" placeholder="Password" required name="password" />
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-check mb-3">
            <input class="form-check-input" name="remember" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              Remember Me
            </label>
          </div>

          <div class="mt-3">
            <p><a href="forgot">Forgotten your password?</a></p>

            <button type="submit" name="login" class="btn btn-outline-light">Log In</button>
            | <a href="register">Create Account</a>
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