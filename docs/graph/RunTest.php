<?php

require_once '../../vendor/autoload.php';

const Vratsa = 'Vratsa';
const Sofia = 'Sofia';
const Pekin = 'Pekin';
const Pleven = 'Pleven';
const Chirpan = 'Chirpan';
const Plovdiv = 'Plovdiv';

$graph = Taniko\Dijkstra\Graph::create();
$graph
    ->add(Vratsa, Sofia, 30)
    ->add(Sofia, Pekin, 2)
    ->add(Pekin, Pleven, 15)
    ->add(Pekin, Chirpan, 3)
    ->add(Chirpan, Pleven, 10)
    ->add(Plovdiv, Plovdiv, 0);

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
