<?php

fscanf(STDIN, "%d\n", $n);
for ($i = 0; $i < $n; $i++)
{
    $expression = str_replace("\n", '', fgets(STDIN));
    preg_match('/[^\d]/', $expression, $operator);
    $operator = $operator[0];
    [$n1, $n2] = explode($operator, $expression);
    switch ($operator)
    {
        case '+':
            $answer = $n1 + $n2;
            break;
        case '*':
            $answer = $n1 * $n2[strlen($n2) - 1];
            break;
        case '-':
            $answer = $n1 - $n2;
            break;
    }
    $maxLength = max(strlen($n1), strlen($operator . $n2), strlen($answer));
    $output = [
        str_repeat(' ', $maxLength - strlen($n1)) . $n1,
        str_repeat(' ', $maxLength - strlen($n2) - 1) . $operator . $n2,
        str_repeat('-', $maxLength),
        str_repeat(' ', $maxLength - strlen($answer)) . $answer
    ];
    if ($operator === '*' && strlen($n2) > 1)
    {
        for ($j = 0; $j < strlen($n2) - 1; $j++)
        {
            $intermediate = $n1 * $n2[strlen($n2) - 2 - $j] . str_repeat(' ', $j + 1);
            $maxLength = max($maxLength, strlen($intermediate));
            for ($k = 0; $k < count($output); $k++)
            {
                $output[$k] = str_repeat(' ', $maxLength - strlen($output[$k])) . $output[$k];
            }
            $output[] = str_repeat(' ', $maxLength - strlen($intermediate)) . $intermediate;
        }
        $output[] = str_repeat('-', $maxLength);
        $answer = $n1 * $n2;
        $output[] = str_repeat(' ', $maxLength - strlen($answer)) . $answer;
    }
    foreach ($output as $row) echo $row . PHP_EOL;
    echo PHP_EOL;
}
