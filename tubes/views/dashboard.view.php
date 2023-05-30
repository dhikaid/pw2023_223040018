<?php require('partials/header.php'); ?>
<?php require('partials/navbar.php'); ?>

<!-- Produk -->
<section class="pt-6 product-detail container pb-5">
    <h2>Welcome, Admin <?= strtoupper($myuser['username']); ?>!</h2>
    <div class="row">
        <div class="col-sm-4 mb-3">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active bg-dark " id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">My Profile</a>
                <a class="list-group-item list-group-item-action bg-dark " id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Products</a>
                <a class="list-group-item list-group-item-action bg-dark" id="list-profile-list" data-bs-toggle="list" href="#list-category" role="tab" aria-controls="list-profile">Category</a>
                <a class="list-group-item list-group-item-action bg-dark " id="list-purchase-list" data-bs-toggle="list" href="#list-purchase" role="tab" aria-controls="list-purchase">Purchases</a>
                <a class="edit-user list-group-item list-group-item-action bg-dark " id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">Users</a>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="tab-content" id="nav-tabContent">
                <!-- My Profile -->
                <div class="tab-pane fade show active " id="list-home" role="tabpanel" aria-labelledby="list-home-list">
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
                                        <!-- <div class="template-dika-lama">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Change Image</label>
                        <input type="file" class="form-control" id="exampleFormControlInput1" placeholder="masdika" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Username</label>
                        <input type="username" class="form-control" id="exampleFormControlInput1" placeholder="masdika" />
                      </div>

                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Address</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Jl. Washington DC, Cimahi, West Bekasi, Argentina" />
                      </div>
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="2000-05-05" />
                      </div>
                    </div> -->
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
                <!-- Edit Product -->
                <div class="tab-pane fade " id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                    <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                                <a href="create?jen=prod" class="btn btn-light">+ New</a>
                                <a href="_backend/cetakPdf.php?jen=prod" class="btn btn-primary">> Export</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <input type="hidden" name="" class="jenisSearch" value="prod">
                                <input type="text" class="form-control bg-dark keyword-prod">
                            </div>
                        </div>
                    </div>
                    <small>Total <b><?= count($products); ?></b> Products</small>
                    <div class="containers-product h-60-vh overflow-y-scroll overflow-x-hidden">

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
                                <?php
                                $i = 1;
                                foreach ($products as $product) : $ratings = ratingProduct($product['id_product']); ?>
                                    <tr>
                                        <th scope="row"><?= $i++; ?></th>
                                        <td>
                                            <img src="_backend/image/product/<?= $product['img']; ?>" width="50" alt="" class="img-fluid rounded" />
                                        </td>

                                        <td><?= $product['product']; ?>
                                            <div class="mt-2 mb-2">
                                                <small>
                                                    <?php if ($ratings['ratings']) : ?>
                                                        <i class="bi bi-star-fill text-light"></i><b> <?= $ratings['ratingVIEW']; ?></b> |
                                                    <?php else : ?>
                                                    <?php endif; ?>
                                                    <?= SoldCount($product['id_product']); ?>
                                                </small>
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
                    </div>
                </div>
                <!-- Edit category -->
                <div class="tab-pane fade " id="list-category" role="tabpanel" aria-labelledby="list-category-list">
                    <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                                <a href="create?jen=categ" class="btn btn-light">+ New</a>
                                <a href="_backend/cetakPdf.php?jen=categ" class="btn btn-primary">> Export</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <input type="hidden" name="" class="jenisSearch" value="categ">
                                <input type="text" class="form-control bg-dark keyword-categ">
                            </div>
                        </div>
                    </div>
                    <small>Total <b><?= count($categories); ?></b> Categories</small>
                    <div class="containers-category h-60-vh overflow-y-scroll overflow-x-hidden">
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
                                <?php $i = 1;
                                foreach ($categories as $category) : ?>
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
                    </div>
                </div>
                <!-- Purchase -->
                <div class="tab-pane fade" id="list-purchase" role="tabpanel" aria-labelledby="list-purchase-list">
                    <div class="row mb-3">
                        <div class="col-sm mb-3">
                            <div class="card text-bg-success mb-3 h-100">
                                <div class="card-header"><small>Success</small></div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?= priceRp(pajak($sucessPurchase, 0.11) + $sucessPurchase); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm mb-3">
                            <div class="card text-bg-warning mb-3 h-100">
                                <div class="card-header"><small>Pending</small></div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?= priceRp(pajak($PendingPurchase, 0.11) + $PendingPurchase); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm mb-3">
                            <div class="card text-bg-danger mb-3 h-100">
                                <div class="card-header"><small>Cancel</small></div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bold"><?= priceRp(pajak($CancelPurchase, 0.11) + $CancelPurchase); ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <?php if (!$ratingproduct && $purchase['transaction_status'] === 'paid') :
                                                ?>
                                                    <div class="">
                                                        <small> <a class="badge text-bg-primary" href="detail?jen=prod&id=<?= $ppurchase['id_product']; ?>&invoice=<?= $purchase['id_transaksi']; ?>" target="_blank">Berikan Ulasan</a></small>
                                                    </div>
                                                <?php elseif ($ratingproduct && $purchase['transaction_status'] === 'paid') : ?>
                                                    <div class="">
                                                        Your review :
                                                        <small> <i class="bi bi-star-fill text-light"></i><b> <?= $ratingproduct[0]['feedback_rating']; ?></b></small>
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
                    </div>
                </div>

                <!-- Edit user -->
                <div class="tab-pane fade " id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">

                    <div class="row">
                        <div class="col-sm">
                            <div class="mb-3">
                                <a href="create?jen=user" class="btn btn-light">+ New</a>
                                <a href="_backend/cetakPdf.php?jen=user" class="btn btn-primary">> Export</a>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <input type="hidden" name="" class="jenisSearch" value="user">
                                <input type="text" class="form-control bg-dark keyword-user">
                            </div>
                        </div>
                    </div>

                    <small>Total <b><?= count($users); ?></b> Users</small>
                    <div class="containers-user h-60-vh overflow-y-scroll overflow-x-hidden">
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
                                <?php
                                $i = 1;
                                foreach ($users as $user) : ?>
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

<script>
    changePass();
    searchAjax();
    searchAjaxPurchase();

    removeSpace();
</script>

<?php require('partials/footer.php'); ?>