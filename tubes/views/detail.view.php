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
        <section class="pt-5 product-detail container pb-5">
            <div class="row ">
                <div class="col-sm-6 pt-3 placeholder-wave rounded">
                    <div class="placeholder rounded">
                        <img src="_backend/image/product/<?= $product['img']; ?>" class="img-fluid rounded opacity-0" alt="..." />
                    </div>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-5 pt-3 placeholder-wave">
                    <h2 class="fw-bold placeholder"><?= $product['product']; ?></h2>
                    <div class="mt-2 mb-2 placeholder">
                        <p>
                            <?php if ($ratings['ratings']) : ?>
                                <i class="bi bi-star-fill text-light"></i><b> <?= $ratings['ratingVIEW']; ?></b> (<?= $ratings['ratingreview']; ?> reviews) |

                            <?php else : ?>
                            <?php endif; ?>
                            <?= SoldCount($product['id_product']); ?>
                        </p>
                    </div>
                    <h4 class="placeholder"><?= priceRp($product['price']); ?></h4>
                    <p class="placeholder"><i class="bi bi-tag-fill"></i> <?= $product['category']; ?></p>
                    <div class="placeholder mb-3">
                        <?= $product['detail']; ?>
                    </div>
                    <div class="d-grid gap-2 ">
                        <form action="" method="POST" name="buyProduct">
                            <select class="form-select bg-dark mb-3 ukuran placeholder" aria-label="Default select example">
                                <option value="<?= $product['ukuran1']; ?>"><?= $product['ukuran1']; ?></option>
                                <option value="<?= $product['ukuran2']; ?>"><?= $product['ukuran2']; ?></option>
                                <option value="<?= $product['ukuran3']; ?>"><?= $product['ukuran3']; ?></option>
                                <option value="<?= $product['ukuran4']; ?>"><?= $product['ukuran4']; ?></option>
                                <option value="<?= $product['ukuran5']; ?>"><?= $product['ukuran5']; ?></option>
                            </select>
                            <div class="row">
                                <div class="col-2 ">
                                    <input type="hidden" class="d-none product-id" value="<?= $product['id_product']; ?>">
                                    <input type="number " min="1" class="form-control text-center bg-dark qty-buy placeholder" value="1" required>
                                </div>

                                <div class="col-10">
                                    <?php if (isset($_SESSION['login'])) { ?>
                                        <button type="submit" class="btn btn-outline-light d-block w-100 submit-cart-detail placeholder"><i class="bi bi-cart-fill"></i> Buy Now</button>
                                    <?php } else { ?>
                                        <a href="login" class="btn btn-outline-light d-block w-100 submit-cart-detail placeholder"><i class="bi bi-cart-fill"></i> Buy Now</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>

                        <div class="rating-form mt-3">
                            <?php if ($formRating) : ?>
                                <div class="bg-dark p-3 rounded form-feedback-rating mb-3">
                                    <form action="" name="feedback-rating">
                                        <p class="placeholder">Kirim feedback mu!</p>
                                        <div class="rating mb-2 placeholder">
                                            <input type="hidden" class="d-none invoice-value" value="<?= $invoice; ?>" required>
                                            <input type="hidden" class="d-none invoice-product" value="<?= $product['id_product']; ?>" required>
                                            <?php for ($i = 1; $i <= 5; $i++) { ?>
                                                <input class="d-none rating-input " type="radio" id="star<?= $i; ?>" name="rating" value="<?= $i; ?>">
                                                <label class="bi bi-star stars-rating" for="star<?= $i; ?>"></label>
                                            <?php }; ?>
                                        </div>
                                        <textarea class="form-control invoice-feedback placeholder" aria-label="With textarea" style="resize: none !important;"></textarea>
                                        <button type="submit" class="btn badge text-bg-light mt-3 placeholder" id="btn-badge-rating">Send</button>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <div class="accordion accordion-flush " id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed bg-dark placeholder" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                            Reviews (<?= $ratings['ratingreview']; ?> reviews)
                                        </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                        <div class="mt-3">
                                            <div class="rating-view"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- PATI -->
                            <!-- <div class="content-php">
                            </div>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item"><a class="page-link" href="#" onclick="clickPage(1)">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#" onclick="clickPage(2)">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav> -->
                        </div>
                    </div>
                </div>
                <section class="suggestion pt-5">
                    <div class="container">
                        <h2 class="text-start fw-bold">SUGGESTIONS</h2>
                        <hr class="border border-secondary border-3 opacity-75">

                        <div class="row row-cols-2 row-cols-md-6 g-4">
                            <?php foreach ($productsRand as $categ) :  $ratingsSugest = ratingProduct($categ['id_product']); ?>
                                <div class="col-sm pt-3 ">
                                    <a href="detail?jen=prod&id=<?= $categ['id_product']; ?>">
                                        <div class="card bg-dark text-light rounded h-100 placeholder-wave">
                                            <div class="placeholder">
                                                <img src="_backend/image/product/<?= $categ['img']; ?>" class="opacity-0 card-img-top 
                                        " alt="...">
                                            </div>
                                            <div class="card-body">
                                                <p class="card-title placeholder text-truncate"><?= $categ['product']; ?></p>
                                                <div class="mt-2 mb-2 placeholder">
                                                    <small>
                                                        <?php if ($ratingsSugest['ratings']) : ?>
                                                            <i class="bi bi-star-fill text-light"></i><b> <?= $ratingsSugest['ratingVIEW']; ?></b> |
                                                        <?php else : ?>

                                                        <?php endif; ?>
                                                        <?= SoldCount($categ['id_product']); ?>
                                                    </small>
                                                </div>
                                                <p class="card-text placeholder"><b><?= priceRp($categ['price']); ?></b></p>

                                            </div>
                                            <div class="card-footer ">
                                                <small class="placeholder"><i class="bi bi-tag-fill"></i> <?= $categ['category']; ?></small>
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


        <!-- off canvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header bg-dark">
                <h5 class="offcanvas-title " id="offcanvasRightLabel">
                    <?= $product['product']; ?> <br>
                    <small> <i class="bi bi-star-fill text-light"></i><b> <?= $ratings['ratingVIEW']; ?></b> (<?= $ratings['ratingreview']; ?> reviews)</small>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body overflow-y-scroll justify-content-center">
                <div class="ratingViewOffCanvas"></div>
            </div>
        </div>


    <?php } elseif ($jenis === "categ") { ?>
        <section class="pt-6 category-detail container pb-5">
            <div class="row">
                <div class="col-sm pt-4 placeholder-wave ">
                    <div class="placeholder rounded">
                        <img src="_backend/image/category/<?= $category['img']; ?>" class="img-fluid rounded opacity-0">
                        </img>
                    </div>
                    <h2 class="mt-3 fw-bold placeholder"><?= $category['category']; ?></h2>
                    <div class="mt-3 placeholder"><?= $category['detail']; ?></div>
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
                        <?php foreach ($pcategories as $categ) :  $ratings = ratingProduct($categ['id_product']); ?>
                            <div class="col-sm pt-3 ">
                                <a href="detail?jen=prod&id=<?= $categ['id_product']; ?>">
                                    <div class="card bg-dark text-light rounded h-100 placeholder-wave">
                                        <div class="placeholder">
                                            <img src="_backend/image/product/<?= $categ['img']; ?>" class="card-img-top opacity-0
                                        " alt="...">
                                        </div>
                                        <div class="card-body">
                                            <p class="card-title placeholder text-truncate"><?= $categ['product']; ?></p>
                                            <div class="mt-2 mb-2 placeholder">
                                                <small>
                                                    <?php if ($ratings['ratings']) : ?>
                                                        <i class="bi bi-star-fill text-light"></i><b> <?= $ratings['ratingVIEW']; ?></b> |
                                                    <?php else : ?>

                                                    <?php endif; ?>
                                                    <?= SoldCount($categ['id_product']); ?>
                                                </small>
                                            </div>
                                            <p class="card-text placeholder"><b><?= priceRp($categ['price']); ?></b></p>

                                        </div>
                                        <div class="card-footer ">
                                            <small class="placeholder"><i class="bi bi-tag-fill"></i> <?= $categ['category']; ?></small>
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
<script>
    skeletonLoading();
    $(document).ready(function() {
        $.ajax({ //create an ajax request to display.php
            type: "GET",
            url: "_backend/feedback.php?idprod=<?= $id; ?>",
            dataType: "html", //expect html to be returned                
            success: function(response) {
                $(".rating-view").html(response);
                //alert(response);
            }
        })
    });
</script>
<?php if (isset($_SESSION['login'])) : ?>
    <script>
        buyProduct(<?= $userDp['id_users']; ?>);
        submitRating(<?= $userDp['id_users']; ?>);
    </script>
<?php endif; ?>


<?php require('partials/footer.php'); ?>