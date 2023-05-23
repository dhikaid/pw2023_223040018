<?php require('partials/header.php'); ?>
<?php require('partials/navbar.php'); ?>
<!-- Produk -->
<section class="pt-6 product-detail container pb-5">
    <h2>List</h2>
    <div class="row placeholder-wave">
        <div class="col-sm-8">
            <table class="table table table-dark table-striped border">
                <tbody>
                    <?php
                    $totalPrice = 0;
                    foreach ($transaksi as $trks) : ?>

                        <tr>
                            <td>
                                <div class="placeholder rounded"><img src="_backend/image/product/<?= $trks['img']; ?>" width="50" class="rounded opacity-0" alt=""></div>
                            </td>
                            <td> <a class="placeholder" href="detail?jen=prod&id=<?= $trks['id_product']; ?>"><?= $trks['product']; ?> (<?= $trks['ukuran']; ?>) </a></td>
                            <td><small class="placeholder">x<?= $trks['qty']; ?></small></td>
                            <td><small class="placeholder"><?= priceRp($trks['pprice']); ?></small></td>
                            <td><a class="placeholder" href="_backend/recart.php?idtrans=<?= $trks['id_transaksi']; ?>&prod=<?= $trks['id_product']; ?>&uku=<?= $trks['ukuran']; ?>"><i class="bi bi-trash"></i></a></td>
                        </tr>

                    <?php
                        $totalPrice = $trks['tpice'] + $totalPrice;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if (!empty($transaksi)) { ?>
            <div class="col-sm-4 mb-3">
                <div class="card bg-dark">
                    <div class="card-body placeholder-wave">
                        <div class="row mb-3">
                            <div class="col">
                                <small class="float-start ">Total :</small>
                            </div>
                            <div class="col">
                                <small class="float-end placeholder"><?= priceRp($totalPrice); ?> </small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <small class="float-start ">Tax (11%) :</small>
                            </div>
                            <div class="col">
                                <small class="float-end placeholder"><?= priceRp(pajak($totalPrice, 0.11)); ?> </small>
                            </div>
                        </div>
                        <hr>
                        <h5>Total :</h5>
                        <h4 class="placeholder"><?= priceRp(pajak($totalPrice, 0.11) + $totalPrice); ?></h4>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-outline-light w-100 d-block placeholder" href="_backend/pay.php?idtrans=<?= $trks['id_transaksi']; ?>&price=<?= pajak($totalPrice, 0.11) + $totalPrice; ?>">Bayar</a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="text-center">
                <p>Keranjang kosong.</p>
            </div>
        <?php } ?>
    </div>
</section>
<script>
    skeletonLoading();
</script>
<?php require('partials/footer.php'); ?>