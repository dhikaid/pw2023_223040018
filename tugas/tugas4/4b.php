<?php

// DATA ARRAY
$tools = [

    "Motherboard",
    "Processor",
    "Hard Disk",
    "PC Cooler",
    "VGA Card",
    "SSD",

];
// SORT IN 
// sort($tools);

// TAMPILKAN 
echo "<h4>Macam-macam perangkat keras komputer</h4>";
$a = 1;
foreach ($tools as $tool) {

    echo "$a. $tool";
    echo "<br>";
    $a++;
}

// tambahkan lalu urutkan
array_push($tools, "Card Reader", "Modem");
sort($tools);


// TAMPILKAN KEDUA
echo "<h4>Macam-macam perangkat keras komputer baru</h4>";
$a = 1;
foreach ($tools as $tool) {

    echo "$a. $tool";
    echo "<br>";
    $a++;
}
