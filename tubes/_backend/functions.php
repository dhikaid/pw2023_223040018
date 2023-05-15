<?php

// SETTINGAN AWAL

date_default_timezone_set('Asia/Jakarta');

// SMTP
$SMTPhost = '';
$SMTPauth = true;
$SMTPname = '';
$SMTPusername = '';
$SMTPpassword = '';
$SMTPsecure = '';
$SMTPport = 587;

// MIDTRANS
$MIDkey = '';
$MIDproduction = false;


// DATABASE
function base_url()
{
    return 'http://localhost/pw2023_223040018/tubes/';
}

function dbConn()
{
    $hostDB = "";
    $userDB = "";
    $passDB = "";
    $nameDB = "";
    return mysqli_connect($hostDB, $userDB, $passDB, $nameDB);
}


// FUNCTION

function timeTambah($tanggal, $tambah)
{
    $date = date_create($tanggal);
    date_add($date, date_interval_create_from_date_string($tambah));
    return date_format($date, "H:i:s d-M-Y ");
}

function timeTambahSQL($tanggal, $tambah)
{
    $date = date_create($tanggal);
    date_add($date, date_interval_create_from_date_string($tambah));
    return date_format($date, "Y-m-d H:i:s ");
}

function pajak($price, $persen)
{
    $return = $price * $persen;
    return floor($return);
}


function query($query)
{
    // DB
    $db = dbConn();

    // Main
    $result = mysqli_query($db, $query);

    // if (mysqli_num_rows($result) === 1) {
    //     return mysqli_fetch_assoc($result);
    // }

    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function priceRp($price)
{
    $hasil = "Rp " . number_format($price, 0, ',', '.');
    return $hasil;
}

function simbolEdit1($act)
{
    if ($act === "u") {
        return "UPDATE";
        exit();
    } elseif ($act === "d") {
        return "DELETE";
        exit();
    } elseif ($act === "c") {
        return "CREATE";
        exit();
    }


    return false;
}


function simbolEdit2($act)
{
    if ($act === "prod") {
        return "PRODUCT";
        exit();
    } elseif ($act === "user") {
        return "USER";
        exit();
    } elseif ($act === "categ") {
        return "CATEGORY";
        exit();
    }


    return false;
}

function uploadImg($jenis)
{

    $nama_img = $_FILES['gambar']['name'];
    $type_img = $_FILES['gambar']['type'];
    $size_img = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $temp_img = $_FILES['gambar']['tmp_name'];


    // IMG NULL

    if ($error == 4) {

        return 'dummy.jpg';
    }


    // EXT IMG
    $tipeImg = ['jpg', 'jpeg', 'png'];

    $ekstensi_img = explode('.', $nama_img);
    $ekstensi_img = end($ekstensi_img);
    $ekstensi_img = strtolower($ekstensi_img);

    if (!in_array($ekstensi_img, $tipeImg)) {
        return [
            'error' => true,
            'message' => "File yang dipilih bukan gambar!",
        ];
        exit();
    }


    // TYPE IMG
    if ($type_img != 'image/jpeg' && $type_img != 'image/png') {
        return [
            'error' => true,
            'message' => "File yang dipilih bukan gambar!",
        ];
        exit();
    }

    // SIZE IMG 5MB
    if ($size_img > 5000000) {
        return [
            'error' => true,
            'message' => "File yang dipilih terlalu besar! (< 5Mb)",
        ];
        exit();
    }


    // LOLOS SEMUA
    // UPLOAD IMG
    $nama_img_baru = uniqid();
    $nama_img_baru .= '.';
    $nama_img_baru .= $ekstensi_img;
    if ($jenis === "prod") {
        move_uploaded_file($temp_img, '_backend/image/product/' . $nama_img_baru);
    } elseif ($jenis === "categ") {
        move_uploaded_file($temp_img, '_backend/image/category/' . $nama_img_baru);
    } elseif ($jenis === "user") {
        move_uploaded_file($temp_img, '_backend/image/user/' . $nama_img_baru);
    }

    return $nama_img_baru;
}

function create($data, $jenis)
{
    $db = dbConn();


    // $gambar = htmlspecialchars($data['gambar']);

    // UP IMAGE
    $gambar = uploadImg($jenis);
    if (isset($gambar['error']) && $gambar['error']) {
        return $gambar;
        exit();
    }

    $name = htmlspecialchars($data['nama']);

    if ($jenis === "prod") {
        $detail = htmlspecialchars($data['detail']);
        $price = htmlspecialchars($data['price']);
        $category = htmlspecialchars($data['idcategory']);
        $ukuran = htmlspecialchars($data['idukuran']);
        // mysqli
        $query = "INSERT INTO product VALUES(null, '$name', '$gambar', '$detail', '$price' ,'$category', '$ukuran')";
        mysqli_query($db, $query);
    } elseif ($jenis === "categ") {
        $detail = htmlspecialchars($data['detail']);
        $query = "INSERT INTO category VALUES(null, '$name', '$gambar', '$detail')";
        mysqli_query($db, $query);
    } elseif ($jenis === "user") {
        return register($data, $gambar);
        die;
    }


    return [
        'error' => false,
        'message' => "Berhasil",
    ];
}


function edit($data, $jenis, $id)
{
    $db = dbConn();

    $id = htmlspecialchars($id);
    $gambar_lama = htmlspecialchars($data['gambar_lama']);
    $name = htmlspecialchars($data['nama']);

    $gambar = uploadImg($jenis);


    if ($gambar == 'dummy.jpg') {
        $gambar = $gambar_lama;
    } else {
        if (isset($gambar['error']) && $gambar['error']) {
            return $gambar;
            exit();
        }
    }


    if ($jenis === "prod") {
        $detail = htmlspecialchars($data['detail']);
        $price = htmlspecialchars($data['price']);
        $category = htmlspecialchars($data['idcategory']);
        $ukuran = htmlspecialchars($data['idukuran']);
        // mysqli
        $query = "UPDATE product SET product ='$name', img='$gambar',detail='$detail', price='$price', id_category='$category', id_ukuran = '$ukuran' WHERE id_product = $id";
    } elseif ($jenis === "categ") {
        $detail = htmlspecialchars($data['detail']);
        $query = "UPDATE category SET category = '$name' , img='$gambar', detail ='$detail' WHERE id_category = '$id'";
    } elseif ($jenis === "user") {
        $name = strtolower(str_replace(' ', '', $name));
        $query = query("SELECT * FROM users WHERE id_users = $id")[0];


        $email = htmlspecialchars($data['email']);
        if ($name !== $query['username']) {
            if (query("SELECT username, email FROM users WHERE username = '$name'")) {
                return [
                    'error' => true,
                    'message' => "Username telah terdaftar.",
                ];
                exit();
            }
        }
        $password =  mysqli_real_escape_string($db, $data['password']);

        // password
        if (empty($password)) {
            $password = $query['password'];
        } else {
            if (strlen($password) < 8) {
                return [
                    'error' => true,
                    'message' => "Password kurang dari 8 karakter.",
                ];
                exit();
            }
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        $address = htmlspecialchars($data['address']);
        $date = htmlspecialchars($data['date']);
        if (!empty(($data['idrole']))) {
            $role = htmlspecialchars($data['idrole']);
            $query = "UPDATE users t1
            JOIN roles t3 ON t1.id_role = t3.id_role
            SET  t1.username = '$name', t1.email = '$email', t1.password = '$password', t1.address = '$address', t1.tgl_lahir = '$date', t1.img = '$gambar', t1.id_role = $role WHERE t1.id_users = '$id';
            ";
        } else {
            $query = "UPDATE users SET username = '$name', email = '$email', password = '$password', address = '$address', tgl_lahir = '$date', img = '$gambar' WHERE id_users = '$id'";
        }
    }
    mysqli_query($db, $query) or die(mysqli_error($db));


    return [
        'error' => false,
        'message' => "Berhasil",
    ];
}

function delete($id, $jenis)
{
    $db = dbConn();



    if ($jenis === "prod") {
        $img = query("SELECT img FROM product WHERE id_product = '$id'")[0];
        if ($img['img'] != 'dummy.jpg') {
            unlink('_backend/image/product/' . $img['img']);
        }
        $query = "DELETE FROM product WHERE id_product = '$id'";

        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    } elseif ($jenis === "categ") {
        $img = query("SELECT img FROM category WHERE id_category = '$id'")[0];
        if ($img['img'] != 'dummy.jpg') {
            unlink('_backend/image/category/' . $img['img']);
        }
        $query = "DELETE FROM category WHERE id_category = '$id'";

        mysqli_query($db, $query);
        return mysqli_affected_rows($db);
    } elseif ($jenis === "user") {
        // $img = query("SELECT img FROM users WHERE id_users = '$id'")[0];
        // if ($img['img'] != 'dummy.jpg') {
        //     unlink('_backend/image/user/' . $img['img']);
        // }
        // // dari roles
        // $role = "DELETE FROM users_roles WHERE id_users = '$id'";
        // mysqli_query($db, $role);
        // $query = "DELETE FROM users WHERE id_users = '$id'";
        if (removeDataUser($id) < 0) {
            return false;
            exit();
        }
        return 2;
    }
}


function login($data)
{
    $db = dbConn();


    $username = htmlspecialchars(strtolower(str_replace(' ', '', $data['username'])));
    $password =  mysqli_real_escape_string($db, $data['password']);

    if ($query = query("SELECT users.id_users, users.password, users.username, users.email , roles.jenis FROM users,  roles WHERE users.id_role = roles.id_role AND users.username = '$username'")) {
        $query = $query[0];

        // cek password
        if (password_verify($password, $query['password'])) {
            // Set session
            $_SESSION['ids'] = $query['id_users'];
            $_SESSION['login'] = true;

            // rememberme 
            if (isset($data['remember'])) {
                // buat cookie
                setcookie('id', $query['id_users'], time() + 2678400);
                setcookie('uid', hash('sha256', $query['username']), time() + 2678400);
            }

            if ($query['jenis'] === "Admin") {
                $_SESSION['rls'] = "a";
                header("Location: dashboard");
                exit;
            } else {
                $_SESSION['rls'] = "u";
                header("Location: profile");
                exit;
            }
        }
    }
    return [
        'error' => true,
        'message' => "Username atau Password salah.",
    ];
}


function register($data, $gambar)
{
    $db = dbConn();


    $username = htmlspecialchars(strtolower(str_replace(' ', '', $data['nama'])));
    $email = htmlspecialchars($data['email']);
    $password1 = mysqli_real_escape_string($db, $data['password1']);
    $password2 = mysqli_real_escape_string($db, $data['password2']);
    $address = htmlspecialchars($data['address']);
    $date = htmlspecialchars($data['date']);

    if (empty($username) || empty($password1) || empty($password2) || empty($email) || empty($address) || empty($date)) {
        return [
            'error' => true,
            'message' => "Field jangan kosong!",
        ];
        exit();
    }

    // if exist
    if (query("SELECT username, email FROM users WHERE username = '$username'")) {
        return [
            'error' => true,
            'message' => "Username telah terdaftar!",
        ];
        exit();
    }

    // min. password

    if (strlen($password1) < 8) {
        return [
            'error' => true,
            'message' => "Password kurang dari 8 karakter!",
        ];
        exit();
    }


    // password1 = passwoed2

    if ($password1 !== $password2) {
        return [
            'error' => true,
            'message' => "Password tidak sesuai",
        ];
        exit();
    }

    // lolos
    if (empty($gambar)) {
        $gambar = 'dummy.jpg';
    }

    $newPassword = password_hash($password1, PASSWORD_DEFAULT);
    $query = "INSERT INTO users VALUES(null, '$username', '$email', '$newPassword', '$address', '$date', '$gambar',2)";
    mysqli_query($db, $query);
    // $query = query("SELECT id_users FROM users WHERE username = '$username' && email = '$email'")[0];
    // $query = "INSERT INTO users_roles VALUES($query[id_users],2)";
    // mysqli_query($db, $query);
    return [
        'error' => false,
        'message' => "Silahkan login. Anda akan diarahkan ke halaman login.",
    ];
}


function changePass($data)
{
    $db = dbConn();

    $id = htmlspecialchars($data['ids']);
    $prev = mysqli_real_escape_string($db, $data['ppass']);
    $new = mysqli_real_escape_string($db, $data['npass']);

    if (empty($id) || empty($prev) || empty($new)) {
        return false;
        exit();
    }

    if (!query("SELECT * FROM users WHERE id_users = $id")[0]) {
        return false;
        exit();
    }



    $query = query("SELECT password FROM users WHERE id_users = $id")[0];



    if (password_verify($prev, $query['password'])) {
        if ($prev === $new) {
            return [
                'error' => true,
                'message' => "The password you entered is the same as your previous password.",
                'code' => 1
            ];
            exit();
        }
        if (strlen($new) < 8) {

            return [
                'error' => true,
                'message' => "Your password is too short.",
                'code' => 2
            ];
            exit();
        }
        $password = password_hash($new, PASSWORD_DEFAULT);

        mysqli_query($db, "UPDATE users SET password = '$password' WHERE id_users= $id ");
        return mysqli_affected_rows($db);
    }
    return [
        'error' => true,
        'message' => "Your password is too short.",
        'code' => 3
    ];
}


function search($keyword, $jenis)
{
    $db = dbConn();
    $pagination = false;
    $filter = '';


    if (isset($keyword['filter'])) {
        $keyFilter = $keyword['filter'];
        $filter = "AND category.id_category = $keyFilter";
    }
    if (isset($keyword['page'])) {
        $page = $keyword['page'];
        $keyword = $keyword['keyword'];
        $pagination = true;
    }

    if ($jenis === 'user') {
        $query = "SELECT DISTINCT users.id_users, users.username, users.img , roles.jenis FROM users, roles WHERE users.id_role = roles.id_role AND (users.username LIKE '%$keyword%' OR roles.jenis LIKE '%$keyword%')";
        // $users = query();
    } elseif ($jenis === 'prod') {
        $query = "SELECT DISTINCT product.product, product.id_product, product.price, product.img, category.category 
        FROM product, category 
        WHERE product.id_category = category.id_category 
        AND (category.category LIKE '%$keyword%' OR product.product LIKE '%$keyword%') $filter";
    } elseif ($jenis === 'categ') {
        $query = "SELECT id_category, img, category FROM category WHERE category LIKE '%$keyword%'";
    }
    if ($pagination) {
        $paginationResult = pagination($query, $page);
        $query = $paginationResult['query'];
        $page = $paginationResult['page'];
    } else {
        $page = 1;
    }

    $result = mysqli_query($db, $query);
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return [
        "query" => $rows,
        "page" => $page,
    ];
}

function pagination($data, $halaman)
{

    $jumlahDataHalaman = 12;
    // mysqli
    $jumlahData = count(query($data));

    $jumlahHalaman = ceil($jumlahData / $jumlahDataHalaman);

    if (isset($halaman) && $halaman !== 0) {
        $activePage = $halaman;
    } else {
        $activePage = 1;
    }

    $awalData = ($jumlahDataHalaman * $activePage) - $jumlahDataHalaman;

    return [
        "query" => "$data LIMIT $awalData, $jumlahDataHalaman",
        "page" => $jumlahHalaman,
    ];
}


function cookie($data)
{
    $db = dbConn();
    $id = $data['id'];
    $uid = $data['uid'];


    // ambil username berdasarkan id

    $result = mysqli_query($db, "SELECT users.id_users, users.username, roles.jenis FROM users, roles WHERE users.id_role = roles.id_role AND users.id_users = '$id'");
    $hasil = mysqli_fetch_assoc($result);
    // cookie dan username
    if ($uid === hash('sha256', $hasil['username'])) {
        $_SESSION['login'] = true;
        $_SESSION['ids'] = $hasil['id_users'];
        if ($hasil['jenis'] === "Admin") {

            $_SESSION['rls'] = "a";
        } else {
            $_SESSION['rls'] = "u";
        }
        header("Location: dashboard");
        exit();
    }

    return false;
}


function cookieOpt($data)
{
    $db = dbConn();
    $id = $data['id'];
    $uid = $data['uid'];
    // ambil username berdasarkan id

    $result = mysqli_query($db, "SELECT users.id_users, users.username, roles.jenis FROM users, roles WHERE users.id_role = roles.id_role AND users.id_users = '$id'");
    $hasil = mysqli_fetch_assoc($result);
    // cookie dan username
    if ($uid === hash('sha256', $hasil['username'])) {
        $_SESSION['login'] = true;
        $_SESSION['ids'] = $hasil['id_users'];
        if ($hasil['jenis'] === "Admin") {

            $_SESSION['rls'] = "a";
        } else {
            $_SESSION['rls'] = "u";
        }
        return true;
        exit();
    }

    return false;
}

function cekUser($data)
{
    return query("SELECT username, id_users FROM users WHERE id_users = '$data'")[0];
}


function sendMessage($data)
{
    $db = dbConn();
    $fromid = $data['fromid'];
    $toid = $data['toid'];
    $message = $data['message'];

    $query = "INSERT INTO messages VALUES(null,'$fromid', '$toid', '$message')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
    // return [
    //     'error' => true,
    //     'message' => "Your password is too short.",
    //     'code' => 2
    // ];
    // exit();
}


function buyProduct($data)
{
    $db = dbConn();

    $product = htmlspecialchars($data['product']);
    $qty = htmlspecialchars($data['qty']);
    $iduser = htmlspecialchars($data['iduser']);
    $ukuran = htmlspecialchars($data['ukuran']);

    if (empty($product) || empty($qty) || empty($iduser) || empty($ukuran) || $qty <= 0) {
        return 0;
        die;
        exit;
    }

    // price
    $priceProduct = query("SELECT price FROM product WHERE id_product = '$product'")[0];
    $price = $priceProduct['price'] * $qty;
    $date =  date('Y-m-d H:i:s');
    $randomid = rand();
    // cek terlebih dahulu
    if (!query("SELECT * FROM transaksi, pembayaran WHERE transaksi.id_transaksi = pembayaran.id_transaksi AND transaksi.id_users = '$iduser' AND pembayaran.status_code = 0 AND status = 0")) {
        $query = "INSERT INTO transaksi VALUES('$randomid', '$date','$iduser', 0)";
        mysqli_query($db, $query);
        $transid = query("SELECT id_transaksi FROM transaksi WHERE id_users = '$iduser' AND status = 0")[0];
        $query = "INSERT INTO pembayaran VALUES('$transid[id_transaksi]', 0, 0, 0, 0)";
        mysqli_query($db, $query);
        $transaksi = query("SELECT transaksi.id_transaksi FROM transaksi, pembayaran WHERE transaksi.id_transaksi = pembayaran.id_transaksi AND transaksi.id_users = '$iduser' AND pembayaran.status_code = 0")[0];
    } else {
        $transaksi = query("SELECT transaksi.id_transaksi FROM transaksi, pembayaran WHERE transaksi.id_transaksi = pembayaran.id_transaksi AND transaksi.id_users = '$iduser' AND pembayaran.status_code = 0")[0];
    }

    if (!query("SELECT * FROM transaksi_detail WHERE id_transaksi = '$transaksi[id_transaksi]' AND id_product = '$product' AND ukuran = '$ukuran'")) {
        $query = "INSERT INTO transaksi_detail VALUES('$transaksi[id_transaksi]','$product','$qty','$price', '$ukuran')";
    } else {
        $query = "UPDATE transaksi_detail SET qty = '$qty' , id_product = '$product' , price = '$price', ukuran = '$ukuran' WHERE id_transaksi = '$transaksi[id_transaksi]' AND id_product = '$product'";
    }

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function rebuyProduct($data, $id)
{
    $db = dbConn();
    $idtrans = $data['idtrans'];
    $idprod = $data['prod'];
    $ukuran = $data['uku'];
    $query = "DELETE FROM transaksi_detail WHERE id_transaksi = '$idtrans' AND id_product = '$idprod' AND ukuran = '$ukuran'";


    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function removeDataUser($data)
{
    $id = $data;
    $db = dbConn();
    $img = query("SELECT img FROM users WHERE id_users = '$id'")[0];


    // data transaksi
    // if ($transaksi = query("SELECT id_transaksi FROM transaksi WHERE id_users = '$id'")) {
    //     if (count($transaksi) > 1) {
    //         foreach ($transaksi as $trks) {
    //             // dari transaksi_detail
    //             $query = "DELETE FROM transaksi_detail WHERE id_transaksi = '$trks[id_transaksi]'";
    //             mysqli_query($db, $query);

    //             // dari pembayaran
    //             $query = "DELETE FROM pembayaran WHERE id_transaksi = '$trks[id_transaksi]'";
    //             mysqli_query($db, $query);
    //         }
    //     } else {
    //         $idtransaksi = $transaksi['id_transaksi'][0];
    //         // dari transaksi_detail
    //         $query = "DELETE FROM transaksi_detail WHERE id_transaksi = '$idtransaksi'";
    //         mysqli_query($db, $query);

    //         // dari pembayaran
    //         $query = "DELETE FROM pembayaran WHERE id_transaksi = '$idtransaksi'";
    //         mysqli_query($db, $query);
    //     }
    // }
    // dari roles
    // $query = "DELETE FROM users_roles WHERE id_users = '$id'";
    // mysqli_query($db, $query);

    if ($img['img'] != 'dummy.jpg') {
        unlink('_backend/image/user/' . $img['img']);
    }
    $query = "DELETE FROM users WHERE id_users = '$id'";
    mysqli_query($db, $query);
    return mysqli_affected_rows($db);
}


function searchPurchase($keyword, $iduser)
{
    $db = dbConn();

    // transaksi
    // $query = "SELECT transaksi.id_transaksi,  transaksi.tanggal, pembayaran.payment_method, pembayaran.payment_code, pembayaran.transaction_status, pembayaran.status_code FROM transaksi, pembayaran WHERE transaksi.id_transaksi = pembayaran.id_transaksi AND pembayaran.status_code != 0 AND transaksi.id_users = '$iduser' AND (pembayaran.transaction_status LIKE '%$keyword%' OR transaksi.id_transaksi LIKE '%$keyword%' OR pembayaran.payment_method LIKE '%$keyword%') ORDER BY transaksi.tanggal DESC";

    $query = "SELECT transaksi.id_transaksi,  transaksi.tanggal, pembayaran.payment_method, pembayaran.payment_code, pembayaran.transaction_status, pembayaran.status_code FROM transaksi, pembayaran, transaksi_detail, product WHERE transaksi.id_transaksi = pembayaran.id_transaksi AND transaksi.id_transaksi = transaksi_detail.id_transaksi AND transaksi_detail.id_product = product.id_product AND pembayaran.status_code != 0  AND transaksi.id_users = '$iduser' AND (pembayaran.transaction_status LIKE '%$keyword%' OR transaksi.id_transaksi LIKE '%$keyword%' OR pembayaran.payment_method LIKE '%$keyword%' OR product.product LIKE '%$keyword%') GROUP BY transaksi.id_transaksi, transaksi.tanggal, pembayaran.payment_method, pembayaran.payment_code, pembayaran.transaction_status, pembayaran.status_code ORDER BY transaksi.tanggal DESC";


    $result = mysqli_query($db, $query);
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function tokenResetPass($data)
{
    $db = dbConn();
    $username = htmlspecialchars(strtolower(str_replace(' ', '', $data['username'])));
    $email = htmlspecialchars($data['email']);
    $date =  date("Y-m-d H:i:s");
    $date24 = timeTambahSQL($date, "24 Hours");

    if ($query = query("SELECT username, email, id_users FROM users WHERE username = '$username' AND email = '$email'")) {

        $iduser = $query[0]['id_users'];
        if (!query("SELECT * FROM user_token WHERE id_users = '$iduser' AND expired > '$date'")) {

            // // hapus uniqnya
            mysqli_query($db, "DELETE FROM user_token WHERE id_users = '$iduser' AND expired < '$date' ");

            // buat uniqurl
            $url = uniqid();
            mysqli_query($db, "INSERT INTO user_token VALUES('$iduser', '$url', '$date24')");
            $url = query("SELECT token FROM user_token WHERE id_users = '$iduser'")[0];
            $url = base_url() . "forgot?reset=" . $url['token'];
            return [
                'error' => false,
                'username' => $query[0]['username'],
                'email' => $query[0]['email'],
                'url' => $url,
                'message' => "Link untuk mengganti password telah dikirim ke email anda.",
            ];
        } else {
            return [
                'error' => true,
                'message' => "Anda sudah membuat request.",
            ];
        }
    } else {
        return [
            'error' => true,
            'message' => "Username atau email salah.",
        ];
    }
}


function resetPass($data, $token)
{
    $db = dbConn();

    $token = htmlspecialchars($token);
    $password1 = mysqli_real_escape_string($db, $data['password1']);
    $password2 = mysqli_real_escape_string($db, $data['password2']);







    // cek profile
    if (!$profile = query("SELECT id_users FROM user_token WHERE token = '$token'")[0]) {
        header("Location: login");
        exit();
    }



    // min. password

    if (strlen($password1) < 8) {
        return [
            'error' => true,
            'message' => "Password minimal 8 karakter",
        ];
        exit();
    }

    // pass1=pass2

    if ($password1 !== $password2) {
        return [
            'error' => true,
            'message' => "Password tidak sesuai",
        ];
        exit();
    }
    // password
    $newPassword = password_hash($password1, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password='$newPassword' WHERE id_users = '$profile[id_users]'";
    mysqli_query($db, $query);
    // hapus
    mysqli_query($db, "DELETE FROM user_token WHERE token = '$token' ");
    return [
        'success' => true,
    ];
}
