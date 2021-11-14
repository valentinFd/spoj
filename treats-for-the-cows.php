<?php

fscanf(STDIN, "%d\n", $n);
$treats = [];
for ($i = 0; $i < $n; $i++)
{
    fscanf(STDIN, "%d\n", $treats[$i]);
}
$s = 0;
for ($day = 1; $day <= $n; $day++)
{
    $min = min($treats[0], $treats[count($treats) - 1]);
    $s += $min * $day;
    array_splice($treats, $min === $treats[0] ? 0 : count($treats) - 1, 1);
}
echo $s;
