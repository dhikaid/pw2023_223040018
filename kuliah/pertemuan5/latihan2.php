<?php
$binatang = ["🐈", "🐇", "🐒", "🐨", "🐄"];
$foods = ['🍍', '🍜', '🍗', '🍛', '🍔', '🍟'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebun Binatang</title>
</head>

<body>
    <h2>Daftar Binatang</h2>
    <ul>
        <!-- binatang dengan for -->
        <?php for ($i = 0; $i < count($binatang); $i++) { ?>
            <li><?= $binatang[$i]; ?></li>
        <?php } ?>
    </ul>
    <hr>
    <h2>Daftar Makanan</h2>
    <ol>
        <!-- makanan dengan foreach -->
        <?php foreach ($foods as $food) : ?>
            <li><?= $food; ?></li>
        <?php endforeach; ?>
    </ol>
</body>

</html>