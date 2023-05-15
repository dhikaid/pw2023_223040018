<?php require('partials/header.php'); ?>
<?php require('partials/navbar.php'); ?>

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
                <div class="col-sm pt-4">
                    <img src="_backend/image/category/<?= $category['img']; ?>" class="img-fluid rounded">
                    </img>
                    <h2 class="mt-3 fw-bold"><?= $category['category']; ?></h2>
                    <p class="mt-3"><?= $category['detail']; ?></p>
                    <hr>
                </div>

                <div class="col-sm">
                    <!-- FORM SEARCH CATEGORY -->
                    <form action="querysearch" method="GET">
                        <div class="input-group mt-4 jumbotron-find m-auto ">
                            <?php if (isset($_GET['keyword'])) : ?>
                                <input type="text" class="form-control bg-dark text-white search-index" name="keyword" autocomplete="off" value="<?= $_GET['keyword']; ?>" required />
                            <?php else : ?>
                                <input type="text" class="form-control bg-dark text-white search-index" name="keyword" autocomplete="off" required />
                            <?php endif; ?>
                            <input type="hidden" class="form-control bg-dark text-white search-index" name="page" value="1" autocomplete="off" required />
                            <input type="hidden" class="form-control bg-dark text-white search-index" name="filter" value="<?= $id; ?>" autocomplete="off" required />
                            <button class="btn btn-light" type="submit" id="button-addon2">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>

                    </form>

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


                    <!-- PAGINATION -->
                    <div class="mt-3">
                        <ul class="pagination justify-content-center ">

                            <?php if ($page > 1) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?jen=<?= $jenis; ?>&id=<?= $id; ?>&page=<?= $page - 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <!-- FOR -->
                            <?php for ($i = 1; $i <= $paginationCateg['page']; $i++) : ?>
                                <?php if ($page == $i) : ?>
                                    <li class="page-item active"><a class="page-link" href="?jen=<?= $jenis; ?>&id=<?= $id; ?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php else : ?>
                                    <li class="page-item"><a class="page-link" href="?jen=<?= $jenis; ?>&id=<?= $id; ?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <?php if ($page < $paginationCateg['page']) : ?>
                                <li class="page-item">
                                    <a class="page-link" href="?jen=<?= $jenis; ?>&id=<?= $id; ?>&page=<?= $page + 1; ?>" aria-label="Previous">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
<?php }
} ?>

<?php if (isset($_SESSION['login'])) : ?>
    <script>
        buyProduct(<?= $userDp['id_users']; ?>);
    </script>
<?php endif; ?>

<?php require('partials/footer.php'); ?>