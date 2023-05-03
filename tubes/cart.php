<?php

// cek login
session_start();

// Require AMBIL
require '_backend/functions.php';

$login = false;

if (isset($_COOKIE['uid'])) {
    $login = cookieOpt($_COOKIE);
    $userDp = cekUser($_SESSION['ids']);
} elseif (isset($_SESSION['login'])) {
    $login = $_SESSION['login'];
    $userDp = cekUser($_SESSION['ids']);
}

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: login");
    exit();
}



// ambil data
$transaksi = query("SELECT transaksi_detail.id_transaksi, product.price as pprice, transaksi_detail.price as tpice, transaksi_detail.qty , transaksi_detail.ukuran, product.product, product.img, product.id_product FROM transaksi, transaksi_detail, product, pembayaran WHERE product.id_product = transaksi_detail.id_product AND transaksi_detail.id_transaksi = transaksi.id_transaksi AND transaksi.id_users = '$userDp[id_users]' AND transaksi.id_transaksi = pembayaran.id_transaksi AND pembayaran.status_code = 0  ");


// header category
$headerCateg = query("SELECT category, id_category FROM category");

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-opt navbar-blur fixed-top">
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

    <!-- Produk -->
    <section class="pt-6 product-detail container pb-5">
        <h2>List</h2>
        <div class="row">
            <div class="col-sm-8">
                <table class="table table table-dark table-striped border">
                    <tbody>
                        <?php
                        $totalPrice = 0;
                        foreach ($transaksi as $trks) : ?>

                            <tr>
                                <td><img src="_backend/image/product/<?= $trks['img']; ?>" width="50" class="rounded" alt=""></td>
                                <td> <a href="detail?jen=prod&id=<?= $trks['id_product']; ?>"><?= $trks['product']; ?> (<?= $trks['ukuran']; ?>) </a></td>
                                <td>x<?= $trks['qty']; ?></td>
                                <td><?= priceRp($trks['pprice']); ?></td>
                                <td><a href="_backend/recart.php?idtrans=<?= $trks['id_transaksi']; ?>&prod=<?= $trks['id_product']; ?>&uku=<?= $trks['ukuran']; ?>"><i class="bi bi-trash"></i></a></td>
                            </tr>

                        <?php
                            $totalPrice = $trks['tpice'] + $totalPrice;
                        endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4 mb-3">
                <div class="card bg-dark">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <small class="float-start">Total :</small>
                            </div>
                            <div class="col">
                                <small class="float-end"><?= priceRp($totalPrice); ?> </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <small class="float-start">Tax (11%) :</small>
                            </div>
                            <div class="col">
                                <small class="float-end"><?= priceRp(pajak($totalPrice, 0.11)); ?> </small>
                            </div>
                        </div>
                        <hr>
                        <h5>Total :</h5>
                        <h4><?= priceRp(pajak($totalPrice, 0.11) + $totalPrice); ?></h4>
                    </div>
                    <div class="card-footer">

                        <a class="btn btn-outline-light w-100 d-block" href="_backend/pay.php?idtrans=<?= $trks['id_transaksi']; ?>&price=<?= pajak($totalPrice, 0.11) + $totalPrice; ?>">Bayar</a>
                    </div>
                </div>
            </div>
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
    <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>