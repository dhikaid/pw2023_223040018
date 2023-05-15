<?php require('partials/header.php'); ?>

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
<script>
    removeSpace();
</script>
<?php require('partials/footer.php'); ?>