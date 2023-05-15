<?php require('partials/header.php'); ?>

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

<script>
    removeSpace();
</script>

<?php require('partials/footer.php'); ?>