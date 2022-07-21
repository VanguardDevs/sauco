<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taxpayer;
use App\Models\Cubicle;

class StatisticsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $taxpayers = Taxpayer::count();
        $cubicles = Cubicle::where('active', '=', true)->count();

        return response()->json([
            'taxpayers' => $taxpayers,
            'cubicles' => $cubicles
        ]);
    }
}
