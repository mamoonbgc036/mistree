<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        return view("dashboard.index");
    }

    public function get_location()
    {
        $reader = new Reader(storage_path('app/GeoLite2-City.mmdb'));

        // Get the IP address of the user
        $ip = request()->ip();

        // Query the GeoLite2 database
        $record = $reader->city($ip);

        $location = [
            'city' => $record->city->name,
            'state' => $record->mostSpecificSubdivision->name,
            'country' => $record->country->name,
            'latitude' => $record->location->latitude,
            'longitude' => $record->location->longitude,
        ];

        return $location;
    }
}
