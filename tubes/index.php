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

// Ambil DATA
$productCategory = query("SELECT id_category, category, img, detail FROM category ORDER BY id_category ASC");

// $products = query("SELECT id_product, product, price, img FROM product ORDER BY RAND() LIMIT 5");
$products = query("SELECT product.product, product.id_product, product.price, product.img, category.category FROM product, category WHERE product.id_category = category.id_category ORDER BY RAND() LIMIT 6");

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

  <!-- section -->

  <!-- <section class="jumbotron">
    <div class="container text-white pt-5 pb-5 ">
      <h1 class="text-center font-bold pt-5 fs-1">JUST DO IT.</h1>
      <form action="querysearch" method="GET">
        <div class="input-group mt-4 jumbotron-find m-auto">
          <input type="text" class="form-control bg-dark text-white search-index" name="keyword" />
          <button class="btn btn-light" type="button" id="button-addon2">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
      <div class="">
        <div class="containers-index">
        </div>
      </div>
    </div>
  </section> -->

  <section class="hero bg-dark vh-100 ">
    <div class="container pt-5 ">
      <div class="row ">
        <div class="col-sm text-start  ">
          <h1 class="fs-alt-1 fw-bold">JUST </h1>
          <h1 class="fs-alt-1 fw-bold">DO</h1>
          <h1 class="fs-alt-1 fw-bold">IT <span>.</span></h1>
          <p class="mt-3">Nike offers high-quality, stylish and innovative sportswear and footwear.</p>
          <a href="#start" class="btn btn-outline-light  w-100 shadow-box">EXPLORE</a>
        </div>
        <div class="col sm">
        </div>
      </div>
    </div>
  </section>


  <section class="searchIdx pt-5" id="start">

    <div class="container">

      <h2 class="text-center fw-bold">FIND YOUR PRODUCT</h2>
      <hr class="border border-secondary border-3 opacity-75">
      <form action="querysearch" method="GET">
        <div class="input-group mt-4 jumbotron-find m-auto ">
          <input type="text" class="form-control bg-dark text-white search-index" name="keyword" autocomplete="off" required />
          <input type="hidden" class="form-control bg-dark text-white search-index" name="page" value="1" autocomplete="off" required />
          <button class="btn btn-light" type="submit" id="button-addon2">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
      <div class="">
        <div class="containers-index">
        </div>
      </div>
    </div>
  </section>
  <!-- SUGGESTIONS -->
  <section class="suggestion pt-5">
    <div class="container">
      <h2 class="text-center fw-bold">SUGGESTIONS</h2>
      <hr class="border border-secondary border-3 opacity-75">

      <div class="row row-cols-1 row-cols-md-6 g-4">
        <?php foreach ($products as $product) : ?>
          <div class="col pt-3 ">
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
        <!-- <div class="col-sm pt-3">
          <a href="">
            <div class="card bg-dark text-light-opt rounded">
              <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/b01c67f2-2481-45d7-b383-a1476d768f6e/air-force-1-07-next-nature-shoes-cg65FM.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-title">Nike Air Jordan</p>
                <h5 class="card-text"><b>Rp. 35.000.000</b></h5>
                <p><i class="bi bi-star-fill"></i> 4.0</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-sm pt-3">
          <a href="">
            <div class="card bg-dark text-light-opt rounded">
              <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/b01c67f2-2481-45d7-b383-a1476d768f6e/air-force-1-07-next-nature-shoes-cg65FM.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-title">Nike Air Jordan</p>
                <h5 class="card-text"><b>Rp. 35.000.000</b></h5>
                <p><i class="bi bi-star-fill"></i> 4.0</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-sm pt-3">
          <a href="">
            <div class="card bg-dark text-light-opt rounded">
              <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/b01c67f2-2481-45d7-b383-a1476d768f6e/air-force-1-07-next-nature-shoes-cg65FM.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-title">Nike Air Jordan</p>
                <h5 class="card-text"><b>Rp. 35.000.000</b></h5>
                <p><i class="bi bi-star-fill"></i> 4.0</p>
              </div>
            </div>
          </a>
        </div>
        <div class="col-sm pt-3">
          <a href="">
            <div class="card bg-dark text-light-opt rounded">
              <img src="https://static.nike.com/a/images/t_PDP_864_v1/f_auto,b_rgb:f5f5f5/b01c67f2-2481-45d7-b383-a1476d768f6e/air-force-1-07-next-nature-shoes-cg65FM.png" class="card-img-top" alt="..." />
              <div class="card-body">
                <p class="card-title">Nike Air Jordan</p>
                <h5 class="card-text"><b>Rp. 35.000.000</b></h5>
                <p><i class="bi bi-star-fill"></i> 4.0</p>
              </div>
            </div>
          </a>
        </div> -->
      </div>
    </div>
  </section>

  <!-- NEWEST -->
  <section class="newest pt-5">
    <div class="container">
      <h2 class="text-center fw-bold">OUR PRODUCT</h2>
      <hr class="border border-secondary border-3 opacity-75">
      <div class="row">


        <?php foreach ($productCategory as $category) : ?>
          <div class="col-sm mb-3">
            <a href="detail?jen=categ&id=<?= $category['id_category']; ?>">
              <!-- <div class="card mb-3 bg-dark ">
            <div class="card-body">
              <div class=" row  position-relative rounded">
                <div class="col-md-6">
                  <img src="_backend/image/category/<?= $category['img']; ?>" class="w-100" alt="..." />
                </div>
                <div class="col-md-6">
                  <h5 class="mt-0 fw-bold"><?= $category['category']; ?></h5>
                  <p>
                    <?= $category['detail']; ?>
                  </p>
                </div>
              </div>
            </div>
          </div> -->

              <div class="card text-bg-dark">
                <img src="_backend/image/category/<?= $category['img']; ?>" class="card-img" alt="...">
                <div class="card-img-overlay">
                  <h4 class="card-title fw-bold"><?= $category['category']; ?></h4>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
      <!-- <a href="">
        <div class="row g-0 bg-dark position-relative rounded mb-4">
          <div class="col-md-6 mb-md-0 p-md-4">
            <img src="https://static.nike.com/a/images/f_auto/dpr_1.0,cs_srgb/h_1999,c_limit/50fb7814-ca5a-4ffc-940f-c9c18c911ff6/nike-just-do-it.jpg" class="w-100" alt="..." />
          </div>
          <div class="col-md-6 p-4 ps-md-0">
            <h5 class="mt-0">KIDS NIKE</h5>
            <p>
              Another instance of placeholder content for this other custom
              component. It is intended to mimic what some real-world content
              would look like, and we're using it here to give the component a
              bit of body and size.
            </p>
          </div>
        </div>
      </a> -->
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