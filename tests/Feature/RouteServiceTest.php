<?php

namespace Tests\Feature;

use App\Models\FillingStation;
use App\Models\Fuel;
use App\Models\Road;
use App\Models\RoadType;
use App\Models\Town;
use App\Services\RouteService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Taniko\Dijkstra\Graph;
use Tests\TestCase;
use Illuminate\Support\Collection;

class RouteServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // todo: find an improved technique to refresh the database
        // https://laracasts.com/discuss/channels/testing/refreshdatabase-trait-doesnt-refresh-database?page=1&replyId=507744
        RefreshDatabaseState::$migrated = false;
    }

    public function test_should_calculate_long_route_correctly()
    {
        $this->seed();

        $towns = Town::all();
        $road_types = RoadType::all();

        $road_type = $road_types->where('id', '=', 1)->first();

        $from_town = $towns->where('id', '=', 1)->first(); // Враца
        $to_town = $towns->where('id', '=', 2)->first(); // София
        $additional_town = $towns->where('id', '=', 3)->first(); // Пекин

        $road_between_from_and_to = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $to_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 150,
        ]);

        $road_between_from_and_additional = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 60,
        ]);

        $road_between_to_and_additional = Road::factory()->create([
            'from_town_id' => $to_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 30,
        ]);

        $roads_collection = new Collection([
            $road_between_from_and_to, $road_between_from_and_additional, $road_between_to_and_additional
        ]);

        // todo: refactor
        $route_service = new RouteService();

        $route_service->getShortestPath(
            'Враца',
            'София',
            $roads_collection,
            new Graph()
        );

//        dd($road_between_from_and_to->minutes_needed,
//            $road_between_from_and_additional->minutes_needed,
//            $road_between_to_and_additional->minutes_needed);
//        dd($route_service, $message, $fullRouteInformation, count($fullRouteInformation));

        // 84 == (from => additional + additional => to) == 56.0 + 28.0
        $this->assertEquals(84, $route_service->getTotalCost());
    }

    public function test_should_calculate_short_route_correctly()
    {
        $this->seed();

        $towns = Town::all();
        $road_types = RoadType::all();

        $road_type = $road_types->where('id', '=', 1)->first();

        $from_town = $towns->where('id', '=', 1)->first(); // Враца
        $to_town = $towns->where('id', '=', 2)->first(); // София
        $additional_town = $towns->where('id', '=', 3)->first(); // Пекин

        $road_between_from_and_to = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $to_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 30,
        ]);

        $road_between_from_and_additional = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 60,
        ]);

        $road_between_to_and_additional = Road::factory()->create([
            'from_town_id' => $to_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 30,
        ]);

        $roads_collection = new Collection([
            $road_between_from_and_to, $road_between_from_and_additional, $road_between_to_and_additional
        ]);

        // todo: refactor
        $route_service = new RouteService();

        $route_service->getShortestPath(
            'Враца',
            'София',
            $roads_collection,
            new Graph()
        );

        // 28 == (from => to) == 28
        $this->assertEquals(28, $route_service->getTotalCost());
    }

    public function test_should_return_zero_cost_when_from_and_to_match()
    {
        $this->seed();

        $towns = Town::all();
        $road_types = RoadType::all();

        $road_type = $road_types->where('id', '=', 1)->first();

        $from_town = $towns->where('id', '=', 1)->first(); // Враца
        $to_town = $towns->where('id', '=', 2)->first(); // София
        $additional_town = $towns->where('id', '=', 3)->first(); // Пекин

        $road_between_from_and_to = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $to_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 30,
        ]);

        $road_between_from_and_additional = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 60,
        ]);

        $road_between_to_and_additional = Road::factory()->create([
            'from_town_id' => $to_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 30,
        ]);

        $roads_collection = new Collection([
            $road_between_from_and_to, $road_between_from_and_additional, $road_between_to_and_additional
        ]);

        // todo: refactor
        $route_service = new RouteService();

        [$message, $fullRouteInformation] = $route_service->getShortestPath(
            'Враца',
            'Враца',
            $roads_collection,
            new Graph()
        );

        // 0 = (from == to)
        $this->assertEquals(0, $route_service->getTotalCost());

        // no route information - from and to are the same
        $this->assertNull($fullRouteInformation);
    }

    public function test_should_calculate_nonexistent_route_correctly()
    {
        $this->seed();

        $towns = Town::all();
        $road_types = RoadType::all();

        $road_type = $road_types->where('id', '=', 1)->first();

        $from_town = $towns->where('id', '=', 1)->first(); // Враца
        $to_town = $towns->where('id', '=', 2)->first(); // София
        $additional_town = $towns->where('id', '=', 3)->first(); // Пекин

        $road_between_from_and_to = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $to_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 150,
        ]);

        $road_between_from_and_additional = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 60,
        ]);

        $road_between_to_and_additional = Road::factory()->create([
            'from_town_id' => $to_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 30,
        ]);

        $roads_collection = new Collection([
            $road_between_from_and_to, $road_between_from_and_additional, $road_between_to_and_additional
        ]);

        // todo: refactor
        $route_service = new RouteService();

        [$message, $fullRouteInformation]=$route_service->getShortestPath(
            'Враца',
            'Пловдив',
            $roads_collection,
            new Graph()
        );

        // 0 = (from =/> to) - no such route exists, cost is 0
        $this->assertEquals(0, $route_service->getTotalCost());

        // no route information - no such route exists
        $this->assertNull($fullRouteInformation);
    }

    public function test_should_return_correct_count_of_paths_having_gas_stations()
    {
        $this->seed();

        $towns = Town::all();
        $road_types = RoadType::all();

        $road_type = $road_types->where('id', '=', 1)->first();

        $from_town = $towns->where('id', '=', 1)->first(); // Враца
        $to_town = $towns->where('id', '=', 2)->first(); // София
        $additional_town = $towns->where('id', '=', 3)->first(); // Пекин

        $road_between_from_and_to = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $to_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 150,
        ]);

        $road_between_from_and_additional = Road::factory()->create([
            'from_town_id' => $from_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 60,
        ]);

        $road_between_to_and_additional = Road::factory()->create([
            'from_town_id' => $to_town->id,
            'to_town_id' => $additional_town->id,
            'road_type_id' => $road_type->id,
            'max_speed_in_km_per_hour' => 90,
            'distance_in_km' => 30,
        ]);

        FillingStation::factory()
            ->has(Fuel::factory()->count(5))
            ->for($road_between_from_and_additional)
            ->create([
                'name' => 'Shell',
                'road_id' => $road_between_from_and_additional->id,
            ]);

        FillingStation::factory()
            ->has(Fuel::factory()->count(5))
            ->for($road_between_to_and_additional)
            ->create([
                'name' => 'Петрол',
                'road_id' => $road_between_to_and_additional->id,
            ]);

        $roads_collection = new Collection([
            $road_between_from_and_to, $road_between_from_and_additional, $road_between_to_and_additional
        ]);

        // todo: refactor
        $route_service = new RouteService();

        [$message, $fullRouteInformation] = $route_service->getShortestPath(
            'Враца',
            'София',
            $roads_collection,
            new Graph()
        );

        // two roads with gas stations
        $this->assertCount(2, $fullRouteInformation);
    }
}
