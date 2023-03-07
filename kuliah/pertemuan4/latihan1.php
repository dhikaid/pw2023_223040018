<?php




function cekAngka($angka)
{
    // echo $angka;
    // echo "<br>";
    if ($angka % 2 == 0) {
        // karena function itu return
        return "$angka - angkanya <b>GENAP!</b>";
    } else {
        return "$angka - angkanya <b>GANJIL!</b>";
    }
}

echo cekAngka(10);
echo "<br>";
echo cekAngka(5);
