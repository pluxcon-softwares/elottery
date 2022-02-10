<?php

namespace App\Http\Controllers;

use App\Jobs\LotteryResultProcessor;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class ResultController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $request->validate([
                'lottery_id' => 'required|numeric',
                'event_date' => 'required|date|date_format:Y-m-d',
                'event'     =>  'required|numeric',
                'w1' => 'required|numeric',
                'w2' => 'required|numeric',
                'w3' => 'required|numeric',
                'w4' => 'required|numeric',
                'w5' => 'required|numeric',
                'm1' => 'numeric',
                'm2' => 'numeric',
                'm3' => 'numeric',
                'm4' => 'numeric',
                'm5' => 'numeric',
            ]);

            if(Result::create($request->all())){
                return response()->json(['success' => 'Lottery result has been added successfully!']);
            };
        }
    }

    public function upload(Request $request)
    {
        // $str_date = str_replace('-', '/', '6-27-2005');
        // return date('Y-m-d', strtotime($str_date));

        $request->validate([
            'lottery_type' => 'required'
        ],['lottery_type.required' => 'Select lottery type to continue']);

        if($request->hasFile('csv_file'))
        {
            $header = [];
            $results = array_map('str_getcsv', file(request()->csv_file));
            $header = $results[0];
            $header2 = array_merge($header, array(12 => 'game_id'));

            unset($results[0]);
            $result_chunks = array_chunk($results, 50);
            $batch = Bus::batch([])->dispatch();
            foreach($result_chunks as $key => $data)
            {
                $lottery = array('game_id' => $request['lottery_type']);
                $batch->add(new LotteryResultProcessor($header2, $data, $lottery));
            }
            return response()->json(['success' => 'File uploaded successfully,
            file will be process automatically at the background']);
        }
    }
}
