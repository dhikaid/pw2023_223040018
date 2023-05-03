<?php


require_once dirname(__FILE__) . '/plugin/vendor/midtrans/midtrans-php/Midtrans.php';
require 'functions.php';

// my code goes here


// Set your Merchant Server Key
\Midtrans\Config::$serverKey = $MIDkey;
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = $MIDproduction;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;


$notif = new \Midtrans\Notification();
$orderid = $notif->order_id;
$transaction = $notif->transaction_status;
$fraud = $notif->fraud_status;
$statuscode = $notif->status_code;
$paymenttype = $notif->payment_type;
$tanggal = $notif->transaction_time;
error_log("Order ID $notif->order_id: " . "transaction status = $transaction, fraud staus = $fraud");


if ($paymenttype == 'bank_transfer') {
    $payment = $notif->va_numbers[0]->bank;
    $paymentcode = $notif->va_numbers[0]->va_number;
} elseif ($paymenttype === 'cstore') {
    $payment = $notif->store;
    $paymentcode = $notif->payment_code;
} elseif ($paymenttype === 'echannel') {
    $payment = $paymenttype;
    $paymentcode = $notif->biller_code . $notif->bill_key;
} elseif ($paymenttype === 'qris') {
    // $payment = $paymenttype . " (" . $notif->acquirer . ")";
    $payment = $paymenttype;
    $paymentcode = $notif->transaction_id;
} else {
    $payment = $paymenttype;
    $paymentcode = "-";
}

if ($transaction === "settlement") {
    $transaction = "paid";
}


$query = "UPDATE transaksi t1
        JOIN pembayaran t2 ON t1.id_transaksi = t2.id_transaksi
        SET
        t1.status = '$statuscode',
        t1.tanggal = '$tanggal',
        t2.payment_method = '$payment', 
        t2.payment_code = '$paymentcode', 
        t2.transaction_status = '$transaction', 
        t2.status_code = '$statuscode' 
        WHERE t1.id_transaksi = '$orderid' AND t2.id_transaksi = '$orderid'";
mysqli_query(dbConn(), $query);
