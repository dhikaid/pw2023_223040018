<?php
// cek login
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
  header("Location: login");
  exit();
}

if ($_SESSION['rls'] !== "u") {
  header("Location: dashboard");
  exit();
}

require '_backend/functions.php';


$myuser = query("SELECT * FROM users WHERE id_users = '$_SESSION[ids]'")[0];

$alert = 0;
// kirim data
if (isset($_POST['create'])) {
  // var_dump($_POST);
  // die;

  $editProfile = edit($_POST, 'user', $_SESSION['ids']);
  if (!$editProfile['error']) {
    echo "<script>
    setTimeout(function() {
        document.location.href='dashboard'
    }, 3000);
    </script>";
  }
}

// header category
$headerCateg = query("SELECT category, id_category FROM category");

// transaksi
$purchases = query("SELECT transaksi.id_transaksi, transaksi.tanggal, pembayaran.payment_method, pembayaran.payment_code, pembayaran.transaction_status, pembayaran.status_code FROM transaksi, pembayaran WHERE transaksi.id_transaksi = pembayaran.id_transaksi AND pembayaran.status_code != 0 AND transaksi.id_users = '$myuser[id_users]' ORDER BY transaksi.tanggal DESC");
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

  <!-- Plugin for this page -->
  <link rel="stylesheet" href="css/sweetalert2.dark.css">

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
            <a class="nav-link btn btn-light text-dark" href="logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Produk -->
  <section class="pt-6 product-detail container pb-5">
    <h2>Welcome, User <?= strtoupper($myuser['username']); ?>!</h2>
    <div class="row">
      <div class="col-sm-4 mb-3">
        <div class="list-group" id="list-tab" role="tablist">
          <a class="list-group-item list-group-item-action active bg-dark" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">My Profile</a>

          <a class="list-group-item list-group-item-action bg-dark" id="list-purchase-list" data-bs-toggle="list" href="#list-purchase" role="tab" aria-controls="list-purchase">Transactions</a>
        </div>
      </div>
      <div class="col-sm-8">
        <div class="tab-content" id="nav-tabContent">
          <!-- My Profile -->
          <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
            <div class="card bg-dark">
              <div class="card-body p-5">
                <form action="" method="post" enctype="multipart/form-data">
                  <div class="row">
                    <?php if (isset($editProfile['error']) &&  !$editProfile['error']) : ?>
                      <div class="pt-4">
                        <div class="alert bg-success alert-dismissible fade show" role="alert">
                          <strong>BERHASIL!</strong> <?= simbolEdit2("user"); ?> berhasil ditambahkan.
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      </div>
                    <?php endif; ?>
                    <?php if (isset($editProfile['error']) &&  $editProfile['error']) : ?>
                      <div class="pt-4">
                        <div class="alert bg-danger alert-dismissible fade show" role="alert">
                          <strong>GAGAL!</strong> <?= $editProfile['message']; ?>
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                      </div>
                    <?php endif; ?>
                    <div class="col-sm m-auto text-center">
                      <img class=" img-preview mb-4 object-fit-cover border rounded-circle" width="300" height="300" src="_backend/image/user/<?= $myuser['img']; ?>" alt="">
                    </div>
                    <div class="col-sm">
                      <div class="mb-3 mt-3">
                        <input type="hidden" name="password">
                        <input type="hidden" name="gambar_lama" value="<?= $myuser['img']; ?>">
                        <label for="exampleFormControlInput1" class="form-label">Gambar :</label>
                        <input type="file" name="gambar" class="form-control bg-dark img-upload" onchange="previewImage()" />
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="exampleFormControlInput1" class="form-label">Name :</label>
                        <input type="text" name="nama" class="form-control bg-dark usernameInput" required value="<?= $myuser['username']; ?>" />
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="exampleFormControlInput1" class="form-label">Email :</label>
                        <input type="email" name="email" class="form-control bg-dark" required value="<?= $myuser['email']; ?>" />
                      </div>
                      <div class=" mb-3 mt-3">
                        <label for="exampleFormControlInput1" class="form-label">Address :</label>
                        <input type="address" name="address" class="form-control bg-dark" required value="<?= $myuser['address']; ?>" />
                      </div>
                      <div class="mb-3 mt-3">
                        <label for="exampleFormControlInput1" class="form-label">Date of Birth :</label>
                        <input type="date" name="date" class="form-control bg-dark" required value="<?= $myuser['tgl_lahir']; ?>" />
                      </div>
                      <div class="mt-5 d-grid gap-2">
                        <button type="submit" name="create" class="btn btn-outline-light">
                          Save Changes
                        </button>
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          Change Password
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Purchase -->
          <div class="tab-pane fade" id="list-purchase" role="tabpanel" aria-labelledby="list-purchase-list">
            <div class="row">
              <div class="col-6">
                <div class="input-group mb-3">
                  <input type="hidden" class="userId" value="<?= $myuser['id_users']; ?>">
                  <input type="hidden" name="" class="jenisSearch" value="purch">
                  <input type="text" class="form-control bg-dark keyword-purchase">
                </div>
              </div>
            </div>
            <div class="containers-purchase h-60-vh overflow-y-scroll overflow-x-hidden">
              <?php

              foreach ($purchases as $purchase) {
              ?>
                <div class="card bg-dark mb-3">
                  <?php
                  if ($purchase['transaction_status'] === 'paid') { ?>
                    <span class="text-center fs-6 rounded-top text-bg-success">Paid</span>
                  <?php } elseif ($purchase['transaction_status'] === 'cancel') {  ?>
                    <span class="text-center fs-6 rounded-top text-bg-danger">Cancel</span>
                  <?php } elseif ($purchase['transaction_status'] === 'expire') {  ?>
                    <span class="text-center fs-6 rounded-top text-bg-danger">Expired</span>
                  <?php } elseif ($purchase['transaction_status'] === 'pending') { ?>
                    <span class="text-center fs-6 rounded-top text-bg-warning">Pending</span>
                  <?php } ?>
                  <?php
                  // productnya
                  $productPurchaces = query("SELECT product.product, transaksi_detail.price as tprice, product.price as pprice, product.img, transaksi_detail.ukuran, transaksi_detail.qty FROM product, transaksi_detail WHERE product.id_product = transaksi_detail.id_product AND transaksi_detail.id_transaksi = '$purchase[id_transaksi]'");
                  $totalPriceP = 0;
                  foreach ($productPurchaces as $ppurchase) {
                    $totalPriceP = $totalPriceP + $ppurchase['tprice'];
                  ?>

                    <div class="card-body">
                      <div class="row">
                        <div class="col-2">
                          <img src="_backend/image/product/<?= $ppurchase['img']; ?>" class="rounded" width="50" alt="">
                        </div>
                        <div class="col-10">
                          <div>
                            <?= $ppurchase['product']; ?> (<?= $ppurchase['ukuran']; ?>) <br>
                            <small><?= priceRp($ppurchase['pprice']); ?> (<i>x<?= $ppurchase['qty']; ?>)</i></small>
                            <br>
                          </div>
                        </div>
                      </div>
                    </div>

                  <?php } ?>
                  <div class="card-footer">
                    <div class="row justify-content-center">
                      <div class="col-sm-6">
                        <small class="float-start"><i>Invoice #<?= $purchase['id_transaksi']; ?></i></small>
                      </div>
                      <div class="col-sm-6">
                        <small class="float-end"><b>Total <?= priceRp(pajak($totalPriceP, 0.11) + $totalPriceP); ?> </b>(Tax 11%)</small>
                      </div>
                    </div>

                    <?php if ($purchase['transaction_status'] === 'pending') { ?>
                      <br>
                      <ul>
                        <li>Payment : <?= strtoupper($purchase['payment_method']); ?></li>
                        <?php if ($purchase['payment_method'] === 'qris') { ?>
                          <img src="https://api.sandbox.midtrans.com/v2/qris/<?= $purchase['payment_code']; ?>/qr-code" class="rounded" alt="" width="150">
                          <p><small>Tenggat bayar : <?= timeTambah($purchase['tanggal'], "15 minutes"); ?></small></p>
                        <?php } else { ?>
                          <li>Payment Code : <?= $purchase['payment_code']; ?></li>
                          <p><small>Tenggat bayar : <?= timeTambah($purchase['tanggal'], "1 day"); ?></small></p>
                        <?php } ?>
                        <a href="_backend/cancelPay?idtrans=<?= $purchase['id_transaksi']; ?>" class="badge btn btn-outline-danger mt-2 float-end">Cancel</a>
                      </ul>
                    <?php } ?>
                  </div>
                </div>
              <?php
              } ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL -->
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content bg-dark">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              Change Password
            </h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="POST" name="formchangepass">
            <input type="hidden" id="ids" value="<?= $myuser['id_users']; ?>">
            <div class="modal-body">
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Previous Password</label>
                <input type="password" class="form-control bg-dark" id="prevpassword" autocomplete="off" required />
              </div>
              <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">New Password</label>
                <input type="password" class="form-control bg-dark" id="newpassword" autocomplete="off" required />
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="submit" name="changepass" class="btn btn-danger">
                Change Password
              </button>
            </div>
          </form>
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
  <!-- wajib js -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/sweetalert2.min.js"></script>
  <script src="js/jquery-3.6.4.min.js"></script>
  <script src="js/custom.js"></script>
  <script>
    changePass();
    searchAjaxPurchase();
    removeSpace();
  </script>
</body>

</html>