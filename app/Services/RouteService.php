<?php

namespace App\Services;

use Illuminate\Support\Collection;
use SendGrid;
use SendGrid\Mail\Mail;
use Taniko\Dijkstra\Graph;
use UnexpectedValueException;

class RouteService
{
    private $allStationsOnAllRoads;
    private $fullRouteInformation;
    private $message;

    public function __construct()
    {
        $this->allStationsOnAllRoads = [];
        $this->fullRouteInformation = null;
        $this->message = null;
    }

    public function getShortestPath(string $from, string $to, Collection $roads, Graph $graph): array
    {
        $this->message = 'За да стигнете от ' . $from . ' до ' . $to;
        if ($from === $to) {
            $this->message .= ' са нужни ' . '0 минути.';
            return [$this->message, $this->fullRouteInformation];
        }

        // go over all the roads
        foreach ($roads as $road) {
            // get all filling stations and cycle them
            foreach ($road->fillingStations as $fillingStation) {
                $fillingStationFuels = [];

                foreach ($fillingStation->fuels as $fuel) {
                    $fillingStationFuels[] = $fuel->name;
                }

                $fuelsInfo = $this->buildFuelsMessage($fillingStationFuels);
                $fillingStationInfo = $this->buildFillingStationMessage($fillingStation->name, $road->from->name, $road->to->name, $fuelsInfo);

                $key = ($road->from->name . $road->to->name);
                $this->allStationsOnAllRoads[$key][] = $fillingStationInfo;
            }

            $graph->add($road->from->name, $road->to->name, $road->minutes_needed);
        }

        try {
            // get the shortest path from and to
            $route = $graph->search($from, $to);

            // generate valid paths in the formats:
            // fromto
            // tofrom
            $validPaths = [];
            for ($i = 0; $i < count($route) - 1; $i++) {
                $validPaths[] = $route[$i] .  $route[$i + 1];
            }

            for ($j = count($route) - 2; $j >= 0; $j--) {
                $validPaths[] = $route[$j + 1] .  $route[$j];
            }

            // transform to the format
            // [ "fromto" => "fromto", "tofrom" => "tofrom" ]
            $paths = [];
            foreach($validPaths as $validPath){
                $paths[$validPath] = $validPath;
            }

            $this->fullRouteInformation = array_intersect_key($this->allStationsOnAllRoads, $paths);

            $cost = $graph->cost($route);
            $this->message .= ' са нужни '. $cost . ' минути.' . PHP_EOL . 'Най-краткият маршрут е ' . join(', ', $route) . '.';
        } catch (UnexpectedValueException $e) {
//                $message = $e->getMessage();
            $this->message = 'Няма наличен път между ' . $from . ' и ' . $to . '.';
        }

        return [$this->message, $this->fullRouteInformation];
    }

    private function buildFuelsMessage(array $fuels): string
    {
        return $fuels ?
            " предлага горивата: " . join(', ', $fuels) . "." :
            " няма нито едно налично гориво.";
    }

    private function buildFillingStationMessage(string $fillingStationName, string $fromName, string $toName, string $fuelsInfo): string
    {
        return "Бензиностация " . $fillingStationName. " (между " . $fromName. " и " . $toName . ")" . $fuelsInfo;
    }
}
