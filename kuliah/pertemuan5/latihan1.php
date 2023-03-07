<?php

// ARRAY
// membuat array

// cara lama
$hari = array('Senin', 'Selasa', 'Rabu');
$bulan = ['Januari', 'Februari', 'Maret'];

$myArray = ['Dhika', 19, false];

$binatang = ["🐈", "🐇", "🐒", "🐨", "🐄"];

// Mencetak Array
echo $hari[1]; // 1 Elemen menggunakan indexnya.
echo "<hr>";
var_dump($hari);
echo "<hr>";
print_r($bulan);
echo "<hr>";
var_dump($myArray);
echo "<hr>";

// Manipulasi Array
// menggunakan index
// Menambahkan elemen diakhir pakai index max 1 array
$hari[] = 'Kamis';
$hari[] = "Jum'at";

print_r($hari);
echo "<hr>";

// Menambah elemen diakhir menggunakan array_push()
array_push($bulan, 'April');
print_r($bulan);
echo "<hr>";

// Menambah elemen diawal menggunakan array_unshift()
array_unshift($binatang, "🐍");
print_r($binatang);
echo "<hr>";

// Menghapus elemen array diakhir, menggunakan array_pop()
array_pop($hari);
print_r($hari);
echo "<hr>";

// Menghapus elemen array diawal, menggunakan array_shift()
array_shift($hari);
print_r($hari);
echo "<hr>";
