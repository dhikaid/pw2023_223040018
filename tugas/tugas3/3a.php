<?php

echo "<h4>Menghitung Luas Lingkaran</h4>";

// Luas lingkaran
function hitungLuasLingkaran($r)
{
    echo "Jari-jari = $r cm";
    echo "<br>";

    // calculate 
    $result = 3.14 * $r * $r;

    // kasih
    echo "Luas lingkaran = $result cm<sup>2</sup>";
}

hitungLuasLingkaran(10);

echo "<hr>";

echo "<h4>Menghitung Keliling Lingkaran</h4>";

// Luas lingkaran
function hitungKelilingLingkaran($r)
{
    echo "Jari-jari = $r cm";
    echo "<br>";

    // calculate 
    $result = 2 * 3.14 * $r;

    // kasih
    echo "Keliling lingkaran = $result cm";
}
hitungKelilingLingkaran(20);
