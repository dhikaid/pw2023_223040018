<?php

$nama = "Bhadrika Aryaputra";
$hari = 'Hari jum\'at kita "ujian"';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 2</title>
</head>

<body>
    <h1>
        <?php
        echo "Hello, $nama  !";
        ?>
    </h1>
    <p>
        <?php
        echo "Pemograman Web";
        ?>
    </p>
    <p><?= $hari; ?></p>
</body>

</html>