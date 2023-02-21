<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        .bungkus {
            width: 246px;
            height: 240px;
            border: 1px solid black;
            overflow: hidden;

        }

        .hitam,
        .putih {
            background-color: black;
            width: 50px;
            height: 50px;
            display: inline-block;
            margin: 0;
            margin-right: -5px;
            margin-top: -5px;
            z-index: -1;
            position: relative;
        }

        .putih {
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="bungkus">
        <?php

        for ($i = 1; $i <= 25; $i++) {
            if ($i % 2 == 0) {

                echo '    <div class="putih"></div>';
            } else {
                echo '   <div class="hitam"></div>';
            }
        }

        ?>
    </div>


</body>

</html>