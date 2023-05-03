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
    if (isset($error['success'])) {
        header("Location: login");
        exit();
    }
}


$date =  date("Y-m-d H:i:s");



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
            <p class="text-center fs-5">Reset Password Your Account.</p>
            <?php if (isset($error['success'])) : ?>
                <div class="pt-2">
                    <div class="alert alert-warning alert-dismissible fade show bg-dark" role="alert">
                        <strong>Sukses!</strong> silahkan login. Anda akan diarahkan ke halaman login.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($error['error'])) : ?>
                <div class="pt-2">
                    <div class="alert bg-danger alert-dismissible fade show bg-dark" role="alert">
                        <strong>Gagal!</strong> <?= $error['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($_GET['reset']) && query("SELECT token FROM user_token WHERE token = '$_GET[reset]' AND expired > '$date'") && !empty($_GET['reset'])) { ?>
                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="password" name="password1" class="form-control bg-dark text-light usernameInput" id="floatingInput" placeholder="name@example.com" required autofocus autocomplete="off" />
                        <label for="floatingInput">New Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="password2" class="form-control bg-dark text-light usernameInput" id="floatingInput" placeholder="name@example.com" required autofocus autocomplete="off" />
                        <label for="floatingInput">Confirm New Password</label>
                    </div>
                    <button type="submit" name="change" class="btn btn-outline-light">Reset</button>
                </form>
            <?php } else { ?>
                <form action="_backend/resetPass.php" method="post">
                    <div class="card-body">
                        <?php if (isset($_GET['return']) && isset($_GET['rmessage']) && !empty($_GET['return']) && !empty($_GET['rmessage'])) : ?>
                            <?php if ($_GET['return'] === "error") : ?>
                                <div class="alert bg-danger alert-dismissible fade show" role="alert">
                                    <?= $_GET['rmessage']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            <?php if ($_GET['return'] === "success") : ?>
                                <div class="alert bg-success alert-dismissible fade show" role="alert">
                                    <?= $_GET['rmessage']; ?>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control bg-dark text-light usernameInput" id="floatingInput" required autofocus autocomplete="off" />
                            <label for="floatingInput">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control bg-dark text-light usernameInput" id="floatingInput" placeholder="name@example.com" required autofocus autocomplete="off" />
                            <label for="floatingInput">Email</label>
                        </div>

                        <div class="mt-3">
                            <button type="submit" name="reset" class="btn btn-outline-light">Reset</button>
                            | <a href="login">Login</a>
                        </div>
                    </div>
                </form>
            <?php } ?>
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