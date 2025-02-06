<?php

for ($i = 1; $i <= 100; $i++) {
    $fizz = (0 === $i % 3);
    $buzz = (0 === $i % 5);

    echo $i . " ";

    if ($fizz) {
        echo 'Fizz';
    }

    if ($buzz) {
        echo 'Buzz';
    }

    echo PHP_EOL;
}
