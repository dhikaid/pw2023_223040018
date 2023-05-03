<?php
// cek login
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: login");
    exit();
} elseif ($_SESSION['rls'] !== "a") {
    header("Location: profile");
    exit();
}

// Require AMBIL
require '_backend/functions.php';

// kenali 
$jenis = $_GET['jen'];

if (empty($jenis) || simbolEdit2($jenis) === false) {
    echo '<script>history.back();</script>';
    exit();
}



// Ambil DATA
$alert = false;
if ($jenis === "prod") {
    $category = query("SELECT id_category, category FROM category");
    // Ukuran
    $ukurans = query("SELECT * from ukuran");
} elseif ($jenis === "user") {
} elseif ($jenis === "categ") {
}


// kirim data
if (isset($_POST['create'])) {
    $create =  create($_POST, $jenis);

    if (!$create['error']) {
        echo "<script>
    setTimeout(function() {
        document.location.href='dashboard'
    }, 3000);
    </script>";
    }
}

// header category
$headerCateg = query("SELECT category, id_category FROM category");




?>


<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nike | Just Do It.</title>

    <!-- BS LOKAL -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- CSS CUS -->
    <link rel="stylesheet" href="css/custom.css" />

    <!-- Plugin for this page -->
    <link rel="stylesheet" href="css/sweetalert2.dark.css">

    <!-- BS ICO -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;600;700&display=swap" rel="stylesheet">

</head>

<body class="text-light-opt">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-blur fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index">
                <img src="img/nav-logo.png" alt="Logo" width="40" class="d-inline-block align-text-top" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index">Home</a>
                    </li>
                    <?php foreach ($headerCateg as $headerca) : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="detail?jen=categ&id=<?= $headerca['id_category']; ?>"><?= $headerca['category']; ?></a>
                        </li>
                    <?php endforeach; ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="cart"> <i class="bi bi-cart-fill"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-light text-dark" href="logout"><i class="bi bi-box-arrow-in-left"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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

    <!-- footer -->

    <footer class=" bg-black p-4">
        <div class="container">
            <div class="fs-5">
                <a href="" class="me-3"> <i class="bi bi-twitter"></i></a>
                <a href="" class="me-3"> <i class="bi bi-youtube"></i></a>
                <a href="" class="me-3"> <i class="bi bi-instagram"></i></a>
            </div>

            <div class="row pt-2">
                <div class="col">
                    <p><i class="bi bi-c-circle"></i> Nike, Inc. All Rights Reserved</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
        removeSpace();
    </script>
</body>

</html>