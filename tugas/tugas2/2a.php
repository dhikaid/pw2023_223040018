<?php

$nama_depan = "Bhadrika";
$nama_belakang = "Aryaputra";

$i = 1;
while ($i <= 100) {
    if ($i % 5 == 0 && $i % 3 == 0) {
        echo $nama_depan . " " . $nama_belakang;
    } else
    if ($i % 3 == 0) {
        echo $nama_depan;
    } elseif ($i % 5 == 0) {
        echo $nama_belakang;
    } else {
        echo $i;
    }
    echo "<br>";
    $i++;
}
