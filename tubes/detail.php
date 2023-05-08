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

// kenali 
$jenis = $_GET['jen'];
$id = $_GET['id'];

if (empty($jenis) || simbolEdit2($jenis) === false || empty($id) || simbolEdit2($jenis) === "USER") {
  echo '<script>history.back();</script>';
  exit();
}

// ambil data
$error = false;
if ($jenis === "prod") {
  if (!$product = query("SELECT product.product, product.detail, product.price, product.img, category.category, product.id_product, ukuran.* FROM product, category,ukuran WHERE id_product = $id AND product.id_ukuran = ukuran.id_ukuran AND product.id_category = category.id_category ")[0]) {
    $error = true;
  } else {
    $productsRand = query("SELECT product.product, product.id_product, product.price, product.img, category.category FROM product, category WHERE product.id_category = category.id_category AND product.id_product != $id ORDER BY RAND() LIMIT 6");
  }
} elseif ($jenis === "categ") {
  if (!$category = query("SELECT img, detail, category FROM category WHERE id_category = $id ")[0]) {
    $error = true;
  } else {
    $pcategories = query("SELECT product.product, product.id_product, product.price, product.img, category.category FROM product, category WHERE category.id_category = $id AND product.id_category = category.id_category ");
  }
}

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
  <?php
  // cek

  if ($error) {  ?>

    <section class="pt-6 mt-5 pb-5 edit-home">
      <div class="container">
        <div class="text-center">
          <p>Data not found.</p>
        </div>
      </div>
    </section>

  <?php } else { ?>

    <!-- Produk -->
    <?php if ($jenis === "prod") { ?>
      <section class="pt-6 product-detail container pb-5">
        <div class="row">
          <div class="col-sm-6 pt-3">
            <img src="_backend/image/product/<?= $product['img']; ?>" class="img-fluid rounded" alt="..." />
          </div>
          <div class="col-sm-1"></div>
          <div class="col-sm-5 pt-3">
            <h2 class="fw-bold"><?= $product['product']; ?></h2>
            <h4><?= priceRp($product['price']); ?></h4>
            <p><i class="bi bi-tag-fill"></i> <?= $product['category']; ?></p>
            <p>
              <?= $product['detail']; ?>
            </p>
            <div class="d-grid gap-2">
              <form action="" method="POST" name="buyProduct">
                <select class="form-select bg-dark mb-3 ukuran" aria-label="Default select example">
                  <option value="<?= $product['ukuran1']; ?>"><?= $product['ukuran1']; ?></option>
                  <option value="<?= $product['ukuran2']; ?>"><?= $product['ukuran2']; ?></option>
                  <option value="<?= $product['ukuran3']; ?>"><?= $product['ukuran3']; ?></option>
                  <option value="<?= $product['ukuran4']; ?>"><?= $product['ukuran4']; ?></option>
                  <option value="<?= $product['ukuran5']; ?>"><?= $product['ukuran5']; ?></option>
                </select>
                <div class="row">
                  <div class="col-2">
                    <input type="hidden" class="d-none product-id" value="<?= $product['id_product']; ?>">
                    <input type="number" min="1" class="form-control text-center bg-dark qty-buy" value="1" required>
                  </div>

                  <div class="col-10">
                    <?php if (isset($_SESSION['login'])) { ?>
                      <button type="submit" class="btn btn-outline-light d-block w-100 submit-cart-detail"><i class="bi bi-cart-fill"></i> Buy Now</button>
                    <?php } else { ?>
                      <a href="login" class="btn btn-outline-light d-block w-100 submit-cart-detail"><i class="bi bi-cart-fill"></i> Buy Now</a>
                    <?php } ?>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <section class="suggestion pt-5">
            <div class="container">
              <h2 class="text-start fw-bold">SUGGESTIONS</h2>
              <hr class="border border-secondary border-3 opacity-75">

              <div class="row row-cols-2 row-cols-md-6 g-4">
                <?php foreach ($productsRand as $pRand) : ?>

                  <div class="col pt-3 ">
                    <a href="detail?jen=prod&id=<?= $pRand['id_product']; ?>">
                      <div class="card bg-dark text-light rounded h-100">
                        <img src="_backend/image/product/<?= $pRand['img']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                          <p class="card-title"><?= $pRand['product']; ?></p>
                          <p class="card-text"><b><?= priceRp($pRand['price']); ?></b></p>
                        </div>
                        <div class="card-footer">
                          <small class=""><i class="bi bi-tag-fill"></i> <?= $pRand['category']; ?></small>
                        </div>
                      </div>
                    </a>
                  </div>

                <?php endforeach; ?>
              </div>
            </div>
          </section>
        </div>
      </section>

      <!-- toast -->
      <div class="toast-container position-fixed top-0 end-0 p-3">
        <div id="liveToastgreen" class="toast bg-success" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              Produk ditambahkan ke keranjang.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
        <div id="liveToastred" class="toast bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="d-flex">
            <div class="toast-body">
              Terjadi kesalahan / produk sudah dikeranjang.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
        </div>
      </div>

    <?php } elseif ($jenis === "categ") { ?>
      <section class="pt-6 category-detail container pb-5">
        <div class="row">
          <div class="col-sm pt-3">
            <img src="_backend/image/category/<?= $category['img']; ?>" class="img-fluid rounded">
            </img>
            <h2 class="mt-3 fw-bold"><?= $category['category']; ?></h2>
            <p class="mt-3"><?= $category['detail']; ?></p>
            <hr>
          </div>

          <div class="col-sm">
            <div class="row row-cols-2 row-cols-md-3 g-4 ">
              <?php foreach ($pcategories as $categ) : ?>
                <div class="col-sm pt-3 ">
                  <a href="detail?jen=prod&id=<?= $categ['id_product']; ?>">
                    <div class="card bg-dark text-light rounded h-100">
                      <img src="_backend/image/product/<?= $categ['img']; ?>" class="card-img-top" alt="...">
                      <div class="card-body">
                        <p class="card-title"><?= $categ['product']; ?></p>
                        <p class="card-text"><b><?= priceRp($categ['price']); ?></b></p>

                      </div>
                      <div class="card-footer">
                        <small class=""><i class="bi bi-tag-fill"></i> <?= $categ['category']; ?></small>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </section>
  <?php }
  } ?>
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
  <?php if (isset($_SESSION['login'])) : ?>
    <script>
      buyProduct(<?= $userDp['id_users']; ?>);
    </script>
  <?php endif; ?>
</body>

</html>