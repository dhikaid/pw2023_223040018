<?php
// cek login
session_start();

require 'functions.php';

// POST
if (isset($_POST['invoice'])) {
    if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
        header("Location: login");
        exit();
    }
    $iduser = $_POST['user'];
    $invoice = $_POST['invoice'];
    $product = $_POST['product'];
    $feedback = $_POST['feedback'];
    $rating = $_POST['rating'];
    if (isset($iduser) && isset($invoice) && isset($product) && isset($feedback) && isset($rating)) {
        if ($iduser === $_SESSION['ids']) {
            $submit = submitRating($_POST);
            echo $submit['message'];
            die();
        }
        echo $_SESSION['ids'];
    }
}

// view
$page = 1;
if (isset($_GET['idprod'])) {
    $idprod = $_GET['idprod'];
    $feedbackSQL = "SELECT feedback.*, users.img, users.username FROM feedback, product, transaksi, users WHERE feedback.id_transaksi = transaksi.id_transaksi AND transaksi.id_users = users.id_users AND feedback.id_product = product.id_product AND product.id_product = '$idprod'";
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    }
    $paginationFeedback = pagination($feedbackSQL, 5, $page);
    $feedback = query($paginationFeedback['query']);
    $feedbackHOME = query("SELECT feedback.*, users.img, users.username FROM feedback, product, transaksi, users WHERE feedback.id_transaksi = transaksi.id_transaksi AND transaksi.id_users = users.id_users AND feedback.id_product = product.id_product AND product.id_product = '$idprod' ORDER BY RAND() LIMIT 0,1 ");
    $productRating = query("SELECT feedback.*, product.product FROM feedback, product WHERE feedback.id_product = product.id_product AND product.id_product = '$idprod'");
    $ratings = ratingProduct($idprod);

    $feedbackMain = $feedbackHOME;
    $paginationCanvas = false;
    if (isset($_GET['canvas'])) {
        $feedbackMain = $feedback;
        $paginationCanvas = true;
    }
}


?>

<?php if (isset($_GET['idprod'])) : ?>
    <?php if ($feedback) : ?>

        <?php foreach ($feedbackMain as $feed) : ?>
            <div class="card bg-dark mb-3">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-1 me-3">
                            <div class="text-center">
                                <img src="_backend/image/user/<?= $feed['img']; ?>" class="rounded-circle" width="40" alt="...">
                            </div>
                        </div>
                        <div class="col">


                            <b> @<?= $feed['username']; ?></b>
                            <br>
                            <div class="">

                                <small>
                                    <?php for ($i = 0; $i < $feed['feedback_rating']; $i++) :  ?><i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                    / 5 </small>
                            </div>
                        </div>
                    </div>
                    <div class="text-feedback ">
                        <p><?= $feed['feedback_text']; ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php if ($paginationCanvas) : ?>
            <div class=" position-absolute bottom-0 start-50 translate-middle-x mt-3">
                <ul class="pagination justify-content-center ">

                    <?php if ($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" onclick="feedbackPage(<?= $idprod; ?>,<?= $page - 1; ?>)" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- FOR -->
                    <?php for ($i = 1; $i <= $paginationFeedback['page']; $i++) : ?>
                        <?php if ($page == $i) : ?>
                            <li class="page-item active"><button class="page-link" onclick="feedbackPage(<?= $idprod; ?>,<?= $i; ?>)"><?= $i; ?></button></li>
                        <?php else : ?>
                            <li class="page-item"><button class="page-link" onclick="feedbackPage(<?= $idprod; ?>,<?= $i; ?>)"><?= $i; ?></button></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($page < $paginationFeedback['page']) : ?>
                        <li class="page-item">
                            <a class="page-link" onclick="feedbackPage(<?= $idprod; ?>,<?= $page + 1; ?>)" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php else : ?>
            <div class="text-end">
                <span class="badge rounded-pill text-bg-light" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" onclick="feedbackPage(<?= $idprod; ?>,1)">View More</span>
            </div>
        <?php endif; ?>


    <?php else : ?>
        <div class="text-center">
            Tidak ada review.
        </div>
    <?php endif; ?>
<?php endif; ?>
<script src="js/custom.js"></script>