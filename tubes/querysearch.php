<?php

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



if (!isset($_GET) || empty($_GET['keyword']) || empty($_GET['page']) || !is_numeric($_GET['page'])) {
    echo '<script>history.back();</script>';
    exit();
}


$keyword = $_GET['keyword'];

$searchKeyword = search($_GET, 'prod');
$keywords = $searchKeyword['query'];


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



    <!-- SUGGESTIONS -->
    <section class="suggestion mt-7 mb-5">
        <div class="container">
            <div class="mt-3 mb-3">
                <h2>Results : <?= $keyword; ?></h2>
                <form action="querysearch" method="GET">
                    <div class="input-group mt-4 jumbotron-find m-auto ">
                        <input type="text" class="form-control bg-dark text-white search-index" name="keyword" autocomplete="off" required />
                        <input type="hidden" class="form-control bg-dark text-white search-index" name="page" value="1" autocomplete="off" required />

                        <button class="btn btn-light" type="submit" id="button-addon2">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
            </div>
            <?php if (empty($keywords)) { ?>
                <p class="text-center">Data not found.</p>
            <?php } else { ?>
                <div class="row row-cols-1 row-cols-md-6 g-4">
                    <?php foreach ($keywords as $product) : ?>

                        <div class="col-sm pt-3 ">
                            <a href="detail?jen=prod&id=<?= $product['id_product']; ?>">
                                <div class="card bg-dark text-light rounded h-100">
                                    <img src="_backend/image/product/<?= $product['img']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-title"><?= $product['product']; ?></p>
                                        <p class="card-text"><b><?= priceRp($product['price']); ?></b></p>
                                    </div>
                                    <div class="card-footer">
                                        <small class=""><i class="bi bi-tag-fill"></i> <?= $product['category']; ?></small>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php endforeach; ?>

                </div>
                <div class="mt-3">
                    <ul class="pagination justify-content-center ">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>

                        <!-- FOR -->
                        <?php for ($i = 1; $i <= $searchKeyword['page']; $i++) : ?>
                            <li class="page-item"><a class="page-link" href="?keyword=<?= $keyword; ?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>
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
        searchAjax1();
    </script>
</body>

</html>