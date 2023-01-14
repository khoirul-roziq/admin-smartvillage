<!-- fungsi prima -->
<?php
function prima($n)
{
    $prima = true;
    for ($i = 2; $i < $n; $i++) {
        if ($n % $i == 0) {
            $prima = false;
        }
    }
    return $prima;
}

for ($i = 1; $i <= 100; $i++) {
    if (prima($i)) {
        echo $i . " ";
    }
}
?>