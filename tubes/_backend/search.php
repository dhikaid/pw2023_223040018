<?php

require 'functions.php';
$jenis = $_GET['jenis'];

if ($jenis === 'purch') {
    $iduser = $_GET['idu'];
    $keyword = searchPurchase(htmlspecialchars($_GET['keyword']), $iduser);
} else {
    if ($jenis === 'prodindex') {
        $jenis2 = 'prod';
    } else {
        $jenis2 = $jenis;
    }
    $searchkeyword = search(htmlspecialchars($_GET['keyword']), $jenis2);
    $keyword = $searchkeyword['query'];
}
?>

<?php if ($jenis === 'user') { ?>
    <table class="table text-light">
        <thead>
            <tr class="sticky-top bg-dark">
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Username</th>

                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($keyword)) : ?>
                <tr>
                    <td colspan="4" class="text-center">Data not found.</td>
                </tr>
            <?php endif; ?>
            <?php
            $i = 1;
            foreach ($keyword as $user) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td>
                        <img src="_backend/image/user/<?= $user['img']; ?>" width="50" height="50" alt="" class="object-fit-cover border rounded-circle" />
                    </td>

                    <td><?= strtolower($user['username']); ?>

                        <?php if ($user['jenis'] === "Admin") { ?>
                            <span class="badge rounded-pill text-bg-danger"><?= $user['jenis']; ?></span>
                        <?php } else { ?>
                            <span class="badge rounded-pill text-bg-success"><?= $user['jenis']; ?></span>
                        <?php } ?>
                    </td>
                    <td>
                        <!-- Example split danger button -->
                        <div class="btn-group">
                            <a href="edit?jen=user&id=<?= $user['id_users']; ?>" type="button" class="badge text-bg-danger">
                                Action
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } elseif ($jenis === 'prod') { ?>
    <table class="table text-light">
        <thead>
            <tr class="sticky-top bg-dark">
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($keyword)) : ?>
                <tr>
                    <td colspan="5" class="text-center">Data not found.</td>
                </tr>
            <?php endif; ?>
            <?php
            $i = 1;
            foreach ($keyword as $product) : $ratings = ratingProduct($product['id_product']); ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td>
                        <img src="_backend/image/product/<?= $product['img']; ?>" width="50" alt="" class="img-fluid rounded" />
                    </td>


                    <td><?= $product['product']; ?>
                        <div class="mt-2 mb-2">
                            <?php if ($ratings['ratings']) : ?>
                                <small>
                                    <?php for ($j = 0; $j < $ratings['ratingVIEW']; $j++) :  ?><i class="bi bi-star-fill"></i>
                                    <?php endfor; ?>
                                    / 5 (<?= $ratings['ratingreview']; ?> reviews) </small>
                            <?php else : ?>
                                <small>
                                    Belum ada rating</small>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td><?php echo priceRp($product['price']) ?></td>
                    <td>
                        <!-- Example split danger button -->
                        <div class="btn-group">
                            <a href="edit?&jen=prod&id=<?= $product['id_product']; ?>" type="button" class="badge text-bg-danger">
                                Action
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } elseif ($jenis === 'categ') { ?>
    <table class="table text-light">
        <thead>
            <tr class="sticky-top bg-dark">
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($keyword)) : ?>
                <tr>
                    <td colspan="5" class="text-center">Data not found.</td>
                </tr>
            <?php endif; ?>
            <?php $i = 1;
            foreach ($keyword as $category) : ?>
                <tr>
                    <th scope="row"><?= $i++; ?></th>
                    <td>
                        <img src="_backend/image/category/<?= $category['img']; ?>" width="50" alt="" class="img-fluid rounded" />
                    </td>

                    <td><?= $category['category']; ?></td>
                    <td>
                        <!-- Example split danger button -->
                        <div class="btn-group">
                            <a href="edit?&jen=categ&id=<?= $category['id_category']; ?>" type="button" class="badge text-bg-danger">
                                Action
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } elseif ($jenis === 'prodindex') { ?>
    <div class="card m-auto bg-dark overflow-y-scroll card-search-index rounded-5 rounded-top-0 mb-2 position-relative">
        <div class="card-body ">
            <?php if (empty($keyword)) : ?>

                <p class="text-center "> Data not found.</p class="text-center ">
            <?php endif; ?>
            <?php foreach ($keyword as $prodi) : ?>
                <div class="mb-3">
                    <a href="detail?jen=prod&id=<?= $prodi['id_product']; ?>">
                        <div class="row">
                            <div class="col-1 m-auto pe-5">
                                <img src="_backend/image/product/<?= $prodi['img']; ?>" class="object-fit-cover rounded-circle" width="40" height="40" alt="">
                            </div>
                            <div class="col">
                                <p><strong><?= $prodi['product']; ?></strong></p>
                                <small><?= priceRp($prodi['price']); ?> | <?= $prodi['category']; ?></small>
                            </div>
                        </div>
                    </a>
                </div>

            <?php endforeach; ?>
        </div>
    </div>
<?php } elseif ($jenis === 'purch') { ?>

    <?php

    foreach ($keyword as $purchase) {
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
            $productPurchaces = query("SELECT product.product, transaksi_detail.price as tprice, product.price as pprice, product.img, transaksi_detail.ukuran, transaksi_detail.qty , product.id_product FROM product, transaksi_detail WHERE product.id_product = transaksi_detail.id_product AND transaksi_detail.id_transaksi = '$purchase[id_transaksi]'");
            $totalPriceP = 0;
            foreach ($productPurchaces as $ppurchase) {
                $ratingproduct = query("SELECT feedback.* FROM feedback, transaksi, product WHERE transaksi.id_transaksi = feedback.id_transaksi AND feedback.id_product = product.id_product AND transaksi.id_transaksi = '$purchase[id_transaksi]' AND product.id_product = '$ppurchase[id_product]'");
                $totalPriceP = $totalPriceP + $ppurchase['tprice'];
            ?>

                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <img src="_backend/image/product/<?= $ppurchase['img']; ?>" class="rounded" width="50" alt="">
                        </div>
                        <div class="col-10">
                            <div>
                                <a target="_blank" href="detail?jen=prod&id=<?= $ppurchase['id_product']; ?>&invoice=<?= $purchase['id_transaksi']; ?>"> <?= $ppurchase['product']; ?> (<?= $ppurchase['ukuran']; ?>)</a> <br>
                                <small><?= priceRp($ppurchase['pprice']); ?> (<i>x<?= $ppurchase['qty']; ?>)</i></small>
                                <br>
                            </div>
                            <?php if (!$ratingproduct) :
                            ?>
                                <div class="">
                                    <small> <a class="badge text-bg-primary" href="detail?jen=prod&id=<?= $ppurchase['id_product']; ?>&invoice=<?= $purchase['id_transaksi']; ?>" target="_blank">Berikan Ulasan</a></small>
                                </div>
                            <?php else : ?>
                                <div class="">
                                    <small>
                                        Your review :
                                        <?php for ($j = 0; $j < $ratingproduct[0]['feedback_rating']; $j++) :  ?> <i class="bi bi-star-fill"></i>
                                        <?php endfor; ?>
                                        / 5 </small>
                                </div>
                            <?php endif; ?>
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


<?php } ?>