<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Country;
use App\Models\Result;

class ChartController extends Controller
{
    public function fetchGames()
    {
        $games = Lottery::with('country:id,name')->get();
        return response()->json($games);
    }

    public function fetchChartByGame(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $charts = Result::select('id', 'event', 'event_date')
            ->where('game_id', $request->game_id)->get();
            return response()->json($charts);
        }
    }

    public function searchDateChart(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $errorMsg = [
                'game_id.required' => 'Select game type',
                'start_year.required' => 'Select Year',
                'start_month.required' => 'Select Month',
                'start_day.required' => 'Select Day',
                'end_year.required' => 'Select Year',
                'end_month.required' => 'Select Month',
                'end_day.required' => 'Select Day',
            ];
            $request->validate([
                'game_id' => 'required|numeric',
                'start_year' => 'required|numeric',
                'start_month' => 'required|numeric',
                'start_day' => 'required|numeric',
                'end_year' => 'required|numeric',
                'end_month' => 'required|numeric',
                'end_day' => 'required|numeric',
            ],$errorMsg);

            $start_date = $request['start_year']."/".$request['start_month']."/".$request['start_day'];
            $end_date = $request['end_year']."/".$request['end_month']."/".$request['end_day'];
            $formatedStartDate = date('Y-m-d', strtotime($start_date));
            $formatedEndDate = date('Y-m-d', strtotime($end_date));

            $charts = Result::with(['lottery'=>function($query){
                $query->with('country:id,name')->select('id', 'name', 'country_id');
            }])->where('game_id', $request['game_id'])
            ->whereBetween('event_date', [$formatedStartDate, $formatedEndDate])
            ->get();

            return $charts;
        }
    }

    public function searchEventChart(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $request->validate([
                'game_id' => 'required|numeric',
                'start_event' => 'required|numeric',
                'end_event' => 'required|numeric',
            ],[
                'game_id.required' => 'Select Game',
                'start_event.required' => 'Select Starting Event',
                'end_event.required' => 'Select Ending Event'
            ]);

            $charts = Result::with(['lottery'=>function($query){
                $query->with('country:id,name')->select('id', 'name', 'country_id');
            }])->where('game_id', $request['game_id'])
                            ->whereBetween('event', [$request->start_event, $request->end_event])
                            ->get();
            return response()->json($charts);
        }
    }
}
