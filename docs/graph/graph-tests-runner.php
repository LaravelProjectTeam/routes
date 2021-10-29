<?php

require_once '../../vendor/autoload.php';

const Vratsa = 'Vratsa';
const Sofia = 'Sofia';
const Pekin = 'Pekin';
const Pleven = 'Pleven';
const Chirpan = 'Chirpan';
const Plovdiv = 'Plovdiv';

$graph = Taniko\Dijkstra\Graph::create();

$graph->add(Vratsa, Sofia, 30);
$graph->add(Sofia, Pekin, 2);
$graph->add(Pekin, Pleven, 15);
$graph->add(Pekin, Chirpan, 3);
$graph->add(Chirpan, Pleven, 10);
$graph->add(Plovdiv, Plovdiv, 0);

$from = Pleven;
$to = Chirpan;

if ($from === $to) {
    echo 'from [' . $from . '] to [' . $to . '] | Distance: ' . 0 . PHP_EOL;
    return;
}

try {
    $route = $graph->search($from, $to);
    $cost  = $graph->cost($route);
} catch (Exception $e) {
    echo $e->getMessage() . PHP_EOL;
    return;
}

echo 'from: [' . $from . '] to [' . $to . '] | ';
echo join(', ', $route);
echo ' | Distance: ' . $cost . PHP_EOL;
