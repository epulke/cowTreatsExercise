<?php

$stdin = fopen('php://stdin', 'r');
$numberOfTreats = (int) fgets($stdin);
$treatsBox = [];
$testCases = 0;
while (true) {
    $treatsBox[] = (int) fgets($stdin);
    $testCases++;
    if ($testCases == $numberOfTreats) break;
}
fclose($stdin);


$memorizedProfit = [];
for ($i = 0; $i < $numberOfTreats; $i++)
{
    $memorizedProfit[$i] = [];
    for ($j = 0; $j < $numberOfTreats; $j++)
    {
        $memorizedProfit[$i][$j] = -1;
    }
}


function profit($firstKey, $lastKey, $treatsBox, &$memorizedProfit)
{
    if ($firstKey > $lastKey) return 0;

    if ($memorizedProfit[$firstKey][$lastKey] != -1) return $memorizedProfit[$firstKey][$lastKey];

    $days = count($treatsBox) - ($lastKey-$firstKey +1) +1;

    $memorizedProfit[$firstKey][$lastKey] = max([
        profit($firstKey+1, $lastKey, $treatsBox, $memorizedProfit) + $days * $treatsBox[$firstKey],
        profit($firstKey, $lastKey-1, $treatsBox, $memorizedProfit) + $days * $treatsBox[$lastKey]
    ]);

    return $memorizedProfit[$firstKey][$lastKey];
}

echo profit(0, $numberOfTreats - 1, $treatsBox, $memorizedProfit);
