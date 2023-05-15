<?php require('partials/header.php'); ?>



<section class="login-area">
    <div class="card bg-dark position-absolute top-50 start-50 translate-middle w-50 p-3 rounded login-area-card">
        <div class="m-auto">
            <img src="img/nav-logo.png" width="50" alt="" />
        </div>
        <p class="text-center fs-5">Reset Password Your Account.</p>
        <?php if (isset($error['success'])) : ?>
            <div class="pt-2">
                <div class="alert bg-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> silahkan login. Silahkan login.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($error['error'])) : ?>
            <div class="pt-2">
                <div class="alert bg-danger alert-dismissible fade show" role="alert">
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
<script>
    removeSpace();
</script>

<?php require('partials/footer.php'); ?>