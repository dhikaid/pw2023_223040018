<?php require('partials/header.php'); ?>
<?php require('partials/navbar.php'); ?>

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

        <h2 class="text-center fw-bold">FIND PRODUCT</h2>
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

        <div class="row row-cols-2 row-cols-md-6 g-4">
            <?php foreach ($products as $product) :  $ratings = ratingProduct($product['id_product']); ?>
                <div class="col-sm pt-3 ">
                    <a href="detail?jen=prod&id=<?= $product['id_product']; ?>">
                        <div class="card bg-dark text-light rounded h-100 placeholder-wave">
                            <div class="placeholder">
                                <img src="_backend/image/product/<?= $product['img']; ?>" class="opacity-0 card-img-top 
                                        " alt="...">
                            </div>
                            <div class="card-body">
                                <p class="card-title placeholder"><?= $product['product']; ?></p>
                                <div class="mt-2 mb-2 placeholder">
                                    <?php if ($ratings['ratings']) : ?>
                                        <small>
                                            <?php for ($j = 0; $j < $ratings['ratingVIEW']; $j++) :  ?><i class="bi bi-star-fill"></i>
                                            <?php endfor; ?>
                                            / 5 </small>
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
    </div>
</section>

<!-- NEWEST -->
<section class="newest pt-5">
    <div class="container">
        <h2 class="text-center fw-bold">OUR PRODUCT</h2>
        <hr class="border border-secondary border-3 opacity-75">
        <div class="row">


            <?php foreach ($productCategory as $category) : ?>
                <div class="col-sm mb-3 placeholder-wave">
                    <a href="detail?jen=categ&id=<?= $category['id_category']; ?>">
                        <div class="card text-bg-dark">
                            <div class="placeholder rounded card-img">
                                <img src="_backend/image/category/<?= $category['img']; ?>" class="card-img opacity-0" alt="...">
                            </div>
                            <div class="card-img-overlay placeholder">
                                <h4 class="card-title fw-bold"><?= $category['category']; ?></h4>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



<script>
    skeletonLoading();
    searchAjax1();
</script>

<?php require('partials/footer.php'); ?>