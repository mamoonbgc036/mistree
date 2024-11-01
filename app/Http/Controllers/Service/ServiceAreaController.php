<?php

namespace App\Http\Controllers\Service;

use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ServiceAreaController extends Controller
{
    public function index($id)
    {
        $thanas = Thana::where('district_id', $id)->get();
        return response()->json($thanas);
    }

    public function unions($id)
    {
        $unions = DB::table('union_wards')->where('thana_upazila_id', $id)->get();
        return response()->json($unions);
    }
}
