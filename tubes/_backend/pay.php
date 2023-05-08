<?php
// cek login
session_start();

require 'functions.php';
require_once dirname(__FILE__) . '/plugin/vendor/midtrans/midtrans-php/Midtrans.php';

$idtrans = $_GET['idtrans'];
$price = $_GET['price'];
$iduser = $_SESSION['ids'];

if (!isset($_SESSION['login']) && !isset($_SESSION['ids']) && !isset($_SESSION['rls'])) {
    header("Location: ../login");
    exit();
}

if (empty($idtrans) || empty($price) || empty($iduser)) {
    header("Location: ../cart");
    exit();
}



if ($qPrice = query("SELECT transaksi.*, pembayaran.*, transaksi_detail.price as tpice FROM transaksi, pembayaran, transaksi_detail WHERE transaksi.id_transaksi = '$idtrans' AND transaksi_detail.id_transaksi = transaksi.id_transaksi AND transaksi.id_users = '$iduser' AND transaksi.id_transaksi = pembayaran.id_transaksi ")) {
    $totalPrice = 0;
    // my code goes here
    foreach ($qPrice as $qp) {
        $totalPrice = $qp['tpice'] + $totalPrice;
    }
    $totalPriceTAX = pajak($totalPrice, 0.11);
    $totalPrice = $totalPrice + $totalPriceTAX;

    if ($price == $totalPrice) {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = $MIDkey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = $MIDproduction;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $idtrans,
                'gross_amount' => $price,
            )
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            // Redirect to Snap Payment Page
            header('Location: ' . $paymentUrl);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        header("Location: ../cart");
        exit();
    }
} else {
    header("Location: ../cart");
    exit();
}
