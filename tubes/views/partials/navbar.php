<?php
// header category
$headerCateg = query("SELECT category, id_category FROM category"); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-blur fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index">
            <img src="img/nav-logo.png" alt="Logo" width="40" class="d-inline-block align-text-top" />
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index">Home</a>
                </li>
                <?php foreach ($headerCateg as $headerca) : ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="detail?jen=categ&id=<?= $headerca['id_category']; ?>"><?= $headerca['category']; ?></a>
                    </li>
                <?php endforeach; ?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="cart"> <i class="bi bi-cart-fill"></i></a>
                </li>
                <li class="nav-item">
                    <?php if ($login) { ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?= strtoupper($userDp['username']); ?>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="dashboard">Profile</a></li>
                                <li><a class="dropdown-item" href="logout">Logout</a></li>
                            </ul>
                        </div>
                    <?php } else { ?>
                        <a class="nav-link btn btn-light text-dark" href="login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                    <?php } ?>
                </li>
            </ul>
        </div>
    </div>
</nav>