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
    <section class="pt-6 mt-5 pb-5 edit-home">
        <div class="container">
            <h2>UPDATE <?= simbolEdit2($jenis); ?></b> </h2>
            <?php if (isset($edit['error']) &&  !$edit['error']) : ?>
                <div class="pt-4">
                    <div class="alert bg-success alert-dismissible fade show" role="alert">
                        <strong>BERHASIL!</strong> <?= simbolEdit2($jenis); ?> berhasil diedit.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isset($edit['error']) &&  $edit['error']) : ?>
                <div class="pt-4">
                    <div class="alert bg-danger alert-dismissible fade show" role="alert">
                        <strong>GAGAL!</strong> <?= $edit['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="col">
                        <!-- default -->

                        <!-- berjenis -->
                        <?php if ($jenis === "prod") { ?>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="col-sm-2 mt-4">
                                        <i>Preview Image</i><br>
                                        <img class="rounded img-preview" src="_backend/image/product/<?= $products['img']; ?>" width="120" alt="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3 mt-5">
                                        <input type="hidden" name="gambar_lama" value="<?= $products['img']; ?>">
                                        <label for="exampleFormControlInput1" class="form-label">Gambar :</label>
                                        <input type="file" name="gambar" class="form-control bg-dark img-upload" onchange="previewImage()" />
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Name :</label>
                                <input type="text" name="nama" class="form-control bg-dark" required value="<?= $products['product']; ?>" />
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Detail :</label>
                                <!-- <textarea type="textarea" name="detail" class="form-control bg-dark" required /></textarea> -->
                                <textarea name="detail" rows="100" cols="80" id="detail"><?php echo $products['detail']; ?></textarea>

                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Price :</label>
                                <input type="number" name="price" class="form-control bg-dark" value="<?= $products['price']; ?>" required />
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Category :</label>
                                <select class="form-select bg-dark" name="idcategory" required>
                                    <?php foreach ($category as $categ) :
                                        if ($products['id_category'] === $categ['id_category']) {
                                    ?>
                                            <option selected value="<?= $categ['id_category']; ?>"><?= $categ['category']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $categ['id_category']; ?>"><?= $categ['category']; ?></option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Ukuran :</label>
                                <select class="form-select bg-dark" name="idukuran" required>
                                    <?php foreach ($ukurans as $ukuran) :
                                        if ($products['id_ukuran'] === $ukuran['id_ukuran']) {
                                    ?>
                                            <option selected value="<?= $ukuran['id_ukuran']; ?>"><?= $ukuran['ukuran1']; ?> - <?= $ukuran['ukuran2']; ?> - <?= $ukuran['ukuran3']; ?> - <?= $ukuran['ukuran4']; ?> - <?= $ukuran['ukuran1']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $ukuran['id_ukuran']; ?>"><?= $ukuran['ukuran1']; ?> - <?= $ukuran['ukuran2']; ?> - <?= $ukuran['ukuran3']; ?> - <?= $ukuran['ukuran4']; ?> - <?= $ukuran['ukuran1']; ?></option>
                                    <?php }
                                    endforeach; ?>
                                </select>
                            </div>
                        <?php } elseif ($jenis === "categ") { ?>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="col-sm-2 mt-4">
                                        <i>Preview Image</i><br>
                                        <img class="rounded img-preview" src="_backend/image/category/<?= $category['img']; ?>" width="120" alt="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3 mt-5">
                                        <input type="hidden" name="gambar_lama" value="<?= $category['img']; ?>">
                                        <label for="exampleFormControlInput1" class="form-label">Gambar :</label>
                                        <input type="file" name="gambar" class="form-control bg-dark img-upload" onchange="previewImage()" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Name :</label>
                                <input type="text" name="nama" class="form-control bg-dark" required value="<?= $category['category']; ?>" />
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Detail :</label>
                                <textarea type="textarea" name="detail" class="form-control bg-dark" required /><?php echo $category['detail']; ?></textarea>
                            </div>
                        <?php } elseif ($jenis === "user") {  ?>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="col-sm-2 mt-4">
                                        <i>Preview Image</i><br>
                                        <img class="rounded img-preview" src="_backend/image/user/<?= $user['img']; ?>" width="120" alt="">
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="mb-3 mt-5">
                                        <input type="hidden" name="gambar_lama" value="<?= $user['img']; ?>">
                                        <label for="exampleFormControlInput1" class="form-label">Gambar :</label>
                                        <input type="file" name="gambar" class="form-control bg-dark img-upload" onchange="previewImage()" />
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Name :</label>
                                <input type="text" name="nama" class="form-control bg-dark usernameInput" required value="<?= $user['username']; ?>" />
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Email :</label>
                                <input type="email" name="email" class="form-control bg-dark" required value="<?= $user['email']; ?>" />
                            </div>
                            <div class=" mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Password :</label>
                                <input type="password" name="password" class="form-control bg-dark" />
                            </div>
                            <div class=" mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Address :</label>
                                <input type="address" name="address" class="form-control bg-dark" required value="<?= $user['address']; ?>" />
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Date of Birth :</label>
                                <input type="date" name="date" class="form-control bg-dark" required value="<?= $user['tgl_lahir']; ?>" />
                            </div>
                            <div class="mb-3 mt-5">
                                <label for="exampleFormControlInput1" class="form-label">Role :</label>
                                <select class="form-select bg-dark" name="idrole" required>
                                    <?php foreach ($roles as $role) :
                                        if ($user['urole'] === $role['id_role']) {
                                    ?>
                                            <option selected value="<?= $role['id_role']; ?>"><?= $role['jenis']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?= $role['id_role']; ?>"><?= $role['jenis']; ?></option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-outline-light float-end" name="create">Update</button>
                        <button type="button" class=" btn btn-danger float-end me-2" onclick="showAlert()">Delete</button>
                        <button type="button" class="btn btn-primary float-end me-2" onclick="history.back();">Back</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php } ?>
<?php if (!$error) { ?>
    <script>
        console.log();

        function showAlert() {
            Swal.fire({
                title: 'Are you sure?',
                text: "With deleted this data, you won't able to see again.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post("delete.php", {
                            jenis: "<?= $jenis; ?>",
                            id: <?= $id; ?>
                        })
                        .done(function(data) {

                            if (data === "Deleted") {
                                // Handle success response
                                Swal.fire(
                                    'Deleted!',
                                    'Your data has been deleted.',
                                    'success'
                                )
                                setTimeout(function() {
                                    document.location.href = 'dashboard.php'
                                }, 3000);
                            } else {
                                Swal.fire(
                                    'Error',
                                    'You cannot delete your account',
                                    'error'
                                )
                            }
                        })
                }
            })

        }
    </script>
    <script>
        removeSpace();
    </script>
    <script>
        CKEDITOR.replace('detail');
        CKEDITOR.addCss('.cke_editable { background-color: #31363c ; color: white }');
    </script>
<?php } ?>

<?php require('partials/footer.php'); ?>