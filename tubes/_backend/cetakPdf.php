<?php
// cek login
session_start();

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: ../login");
    exit();
}


if ($_SESSION['rls'] !== "a") {
    header("Location: ../profile");
    exit();
}

// panggil
require_once __DIR__ . '/plugin/vendor/autoload.php';
require 'functions.php';


// kenali 
$jenis = $_GET['jen'];

if (empty($jenis) || simbolEdit2($jenis) === false) {
    echo '<script>history.back();</script>';
    exit();
}

if ($jenis === 'prod') {
    $query = query("SELECT product.product, product.id_product, product.price, product.img, category.category 
FROM product, category 
WHERE product.id_category = category.id_category");
} elseif ($jenis === 'categ') {
    $query = query("SELECT id_category, img, category, detail FROM category");
} elseif ($jenis === 'user') {
    $query = query("SELECT DISTINCT users.id_users as ids, users.username, users.img , roles.jenis, users.email FROM users, roles WHERE users.id_role = roles.id_role");
}

$filename = date('d-m-Y H:i') . ' WIB - LIST ' . simbolEdit2($jenis) . '.pdf';
echo $filename;

$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . $filename . '</title>

    <style>
        .m-auto {
            margin: auto;
        }

        img {
            width: 100px;
        }
    </style>

</head>

<body>
    <div class="m-auto">';

if ($jenis === 'prod') {
    $html .= '<h1>List Product : </h1>
    <table border="1" cellpadding="10" cellspacing="0" class="m-auto">
        <tr>
            <th>No. </th>
            <th>Gambar</th>
            <th>Product</th>
            <th>Price</th>
            <th>Category</th>
            <th>ID</th>
        </tr>';

    $i = 1;
    foreach ($query as $prod) {
        $html .= '
    <tr>
        <td>' . $i++ . '</td>
        <td><img src="image/product/' . $prod['img'] . '" alt=""></td>
        <td>' . $prod['product'] . '</td>
        <td>' . priceRp($prod['price']) . '</td>
        <td>' . $prod['category'] . '</td>
        <td>' . $prod['id_product'] . '</td>
    </tr>
    ';
    }
}

if ($jenis === 'user') {
    $html .= '<h1>List Users : </h1>
    <table border="1" cellpadding="10" cellspacing="0" class="m-auto">
        <tr>
            <th>No. </th>
            <th>Gambar</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>ID</th>
        </tr>';

    $i = 1;
    foreach ($query as $user) {
        $html .= '
    <tr>
        <td>' . $i++ . '</td>
        <td><img src="image/user/' . $user['img'] . '" alt=""></td>
        <td>' . $user['username'] . '</td>
        <td>' . $user['email'] . '</td>
        <td>' . $user['jenis'] . '</td>
        <td>' . $user['ids'] . '</td>
    </tr>
    ';
    }
}

if ($jenis === 'categ') {
    $html .= '<h1>List Category : </h1>
    <table border="1" cellpadding="10" cellspacing="0" class="m-auto">
        <tr>
            <th>No. </th>
            <th>Gambar</th>
            <th>Category</th>
            <th>Detail</th>
            <th>ID</th>
        </tr>';

    $i = 1;
    foreach ($query as $category) {
        $html .= '
    <tr>
        <td>' . $i++ . '</td>
        <td><img src="image/category/' . $category['img'] . '" alt=""></td>
        <td>' . $category['category'] . '</td>
        <td>' . $category['detail'] . '</td>
        <td>' . $category['id_category'] . '</td>
    </tr>
    ';
    }
}

$html .= '</table>
</div>
</body>           

</html>';
$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);
$mpdf->Output($filename, \Mpdf\Output\Destination::INLINE);
