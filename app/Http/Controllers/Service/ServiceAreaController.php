<?php

namespace App\Http\Controllers\Service;

use App\Models\Thana;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceAreaController extends Controller
{
    public function index($id)
    {

        $thanas = Thana::where('districtid', $id)->get();
        return response()->json($thanas);
    }
}
