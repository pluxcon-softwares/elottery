<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Result;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {
        $results = DB::table('results')->selectRaw("w1, w3, concat(w1 + w3 ) AS colTotal")
                ->havingRaw("colTotal < 70")
                //->limit(5)
                ->get();
        return response()->json($results);
    }
}
