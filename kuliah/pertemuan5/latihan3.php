<!DOCTYPE html>
<?php
$mahasiswa = [['Bhadrika', '🐈', '🍟'], ['Vity', '🐊', '🍿'], ['Lia', '🐇', '☕']];

echo $mahasiswa[2][1];
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
</head>

<body>
    <h2>Daftar Mahasiswa</h2>
    <?php foreach ($mahasiswa as $mhs) : ?>
        <ul>
            <li>Nama : <?= $mhs[0]; ?></li>
            <li>Peliharaan : <?= $mhs[1]; ?></li>
            <li>Makanan Favorit : <?= $mhs[2]; ?></li>
        </ul>
    <?php endforeach; ?>
</body>

</html>