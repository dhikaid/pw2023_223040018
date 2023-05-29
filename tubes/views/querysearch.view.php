<?php require('partials/header.php'); ?>
<?php require('partials/navbar.php'); ?>


<section class="suggestion mt-7 mb-5">
    <div class="container">
        <div class="mt-3 mb-3">
            <h2>Results : <?= $keyword; ?></h2>
            <form action="querysearch" method="GET">
                <div class="input-group mt-4 jumbotron-find m-auto ">
                    <?php if (isset($_GET['keyword'])) : ?>
                        <input type="text" class="form-control bg-dark text-white search-index" name="keyword" autocomplete="off" value="<?= $_GET['keyword']; ?>" required />
                    <?php else : ?>
                        <input type="text" class="form-control bg-dark text-white search-index" name="keyword" autocomplete="off" required />
                    <?php endif; ?>
                    <input type="hidden" class="form-control bg-dark text-white search-index" name="page" value="1" autocomplete="off" required />

                    <button class="btn btn-light" type="submit" id="button-addon2">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                <div class="">
                    <div class="containers-index">
                    </div>
                </div>
                <div class="mt-3">
                    <div class="mb-2">
                        <small>Filter</small>
                    </div>
                    <?php foreach ($headerCateg as $filterCateg) : ?>
                        <?php if (isset($_GET['filter']) && $_GET['filter'] == $filterCateg['id_category']) : ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input check-filter" type="radio" name="filter" id="inlineRadio<?= $filterCateg['id_category']; ?>" value="<?= $filterCateg['id_category']; ?>" checked>
                                <label class="form-check-label" for="inlineRadio1"><?= $filterCateg['category']; ?></label>
                            </div>
                        <?php else : ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input check-filter" type="radio" name="filter" id="inlineRadio<?= $filterCateg['id_category']; ?>" value="<?= $filterCateg['id_category']; ?>">
                                <label class="form-check-label" for="inlineRadio<?= $filterCateg['id_category']; ?>"><?= $filterCateg['category']; ?></label>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    <span class="badge rounded-pill text-bg-light" onclick="resetFilter();">Reset</span>
                </div>
            </form>

        </div>
        <?php if (empty($keywords)) { ?>
            <p class="text-center">Data not found.</p>
        <?php } else { ?>
            <div class="row row-cols-2 row-cols-md-6 g-4">
                <?php foreach ($keywords as $product) :  $ratings = ratingProduct($product['id_product']); ?>
                    <div class="col-sm pt-3 ">
                        <a href="detail?jen=prod&id=<?= $product['id_product']; ?>">
                            <div class="card bg-dark text-light rounded h-100 placeholder-wave">
                                <div class="placeholder">
                                    <img src="_backend/image/product/<?= $product['img']; ?>" class="card-img-top opacity-0 
                                        " alt="...">
                                </div>
                                <div class="card-body">
                                    <p class="card-title placeholder"><?= $product['product']; ?></p>
                                    <div class="mt-2 mb-2 placeholder">
                                        <?php if ($ratings['ratings']) : ?>
                                            <small> <i class="bi bi-star-fill text-light"></i><b> <?= $ratings['ratingVIEW']; ?></b></small>
                                        <?php else : ?>
                                            <small>
                                                Belum ada rating</small>
                                        <?php endif; ?>
                                    </div>
                                    <p class="card-text placeholder"><b><?= priceRp($product['price']); ?></b></p>

                                </div>
                                <div class="card-footer ">
                                    <small class="placeholder"><i class="bi bi-tag-fill"></i> <?= $product['category']; ?></small>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>

            </div>
            <div class="mt-3">
                <ul class="pagination justify-content-center ">

                    <?php if ($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?keyword=<?= $keyword; ?>&page=<?= $page - 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- FOR -->
                    <?php for ($i = 1; $i <= $searchKeyword['page']; $i++) : ?>
                        <?php if ($page == $i) : ?>
                            <li class="page-item active"><a class="page-link" href="?keyword=<?= $keyword; ?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php else : ?>
                            <li class="page-item"><a class="page-link" href="?keyword=<?= $keyword; ?>&page=<?= $i; ?>"><?= $i; ?></a></li>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($page < $searchKeyword['page']) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?keyword=<?= $keyword; ?>&page=<?= $page + 1; ?>" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php } ?>
    </div>



</section>
<script>
    skeletonLoading();
    searchAjax1();
</script>

<?php require('partials/footer.php'); ?>