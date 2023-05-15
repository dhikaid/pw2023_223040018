<?php require('partials/header.php'); ?>
<?php require('partials/navbar.php'); ?>
<!-- Produk -->
<section class="pt-6 mt-5 pb-5 edit-home ">
    <div class="container">
        <h2>CREATE <?= simbolEdit2($jenis); ?></b> </h2>
        <?php if (isset($create['error']) &&  !$create['error']) : ?>
            <div class="pt-4">
                <div class="alert bg-success alert-dismissible fade show" role="alert">
                    <strong>BERHASIL!</strong> <?= simbolEdit2($jenis); ?> berhasil ditambahkan.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <?php if (isset($create['error']) &&  $create['error']) : ?>
            <div class="pt-4">
                <div class="alert bg-danger alert-dismissible fade show" role="alert">
                    <strong>GAGAL!</strong> <?= $create['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="col">
                    <!-- default -->
                    <div class="row">
                        <div class="col-sm-2 mt-4">
                            <i>Preview Image</i><br>
                            <img class="rounded img-preview" src="_backend/image/product/dummy.jpg" width="120" alt="">
                        </div>
                        <div class="col-sm">
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Gambar :</label>
                                <input type="file" name="gambar" class="form-control bg-dark img-upload" onchange="previewImage()" />
                            </div>
                        </div>
                    </div>



                    <!-- berjenis -->
                    <?php if ($jenis === "prod") { ?>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Name :</label>
                            <input type="text" name="nama" class="form-control bg-dark" required />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Detail :</label>
                            <textarea type="textarea" name="detail" class="form-control bg-dark" required /></textarea>
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Price :</label>
                            <input type="number" name="price" class="form-control bg-dark" required />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Category :</label>
                            <select class="form-select bg-dark" name="idcategory" required>
                                <?php foreach ($category as $categ) : ?>
                                    <option value="<?= $categ['id_category']; ?>"><?= $categ['category']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Ukuran :</label>
                            <select class="form-select bg-dark" name="idukuran" required>
                                <?php foreach ($ukurans as $ukuran) : ?>
                                    <option value="<?= $ukuran['id_ukuran']; ?>"><?= $ukuran['ukuran1']; ?> - <?= $ukuran['ukuran2']; ?> - <?= $ukuran['ukuran3']; ?> - <?= $ukuran['ukuran4']; ?> - <?= $ukuran['ukuran1']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    <?php } elseif ($jenis === "categ") { ?>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Name :</label>
                            <input type="text" name="nama" class="form-control bg-dark" required />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Detail :</label>
                            <textarea type="textarea" name="detail" class="form-control bg-dark" required /></textarea>
                        </div>
                    <?php } elseif ($jenis === "user") {  ?>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Name :</label>
                            <input type="text" name="nama" class="form-control bg-dark usernameInput" required />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Email :</label>
                            <input type="email" name="email" class="form-control bg-dark" required />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Password :</label>
                            <input type="password" name="password1" class="form-control bg-dark" required />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Confirm Password :</label>
                            <input type="password" name="password2" class="form-control bg-dark" required />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Address :</label>
                            <input type="address" name="address" class="form-control bg-dark" required />
                        </div>
                        <div class="mb-3 mt-5">
                            <label for="exampleFormControlInput1" class="form-label">Date of Birth :</label>
                            <input type="date" name="date" class="form-control bg-dark" required />
                        </div>
                    <?php } ?>
                    <button type="submit" class="btn btn-outline-light float-end" name="create">Create</button>
                    <button class="btn btn-primary float-end me-2" onclick="history.back();">Back</button>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
    removeSpace();
</script>

<?php require('partials/footer.php'); ?>