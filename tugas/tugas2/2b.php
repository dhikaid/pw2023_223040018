<?php

for ($i = 0; $i < 10; $i++) {
    $u = 1;

    for ($j = 0; $j <= $i; $j++) {
        echo $u++ . " ";
    }
    echo "<br>";
}
