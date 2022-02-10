<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lottery;

class LotteryController extends Controller
{
    public function lotteries()
    {
        $lotteries = Lottery::with("country:id,name")->get();

        return response()->json($lotteries);
    }

    public function lotteriesByCountry(Request $request)
    {
        $lotteries = Lottery::with('country:id,name')->where('country_id', $request->country_id)->get();
        return response()->json($lotteries);
    }

    public function lotteryById(Request $request)
    {
        $lottery = Lottery::with('country:id,name')
        ->where('id', $request->lottery_id)->first();
        return response()->json($lottery);
    }

    public function create(Request $request)
    {
        $request->validate([
            'country_id' => 'required|numeric',
            'name' => 'required|unique:lotteries,name'
        ]);

        Lottery::create($request->all());

        return response()->json(['success' => 'Lotto type has been created!']);
    }

    public function update(Request $request)
    {
        if($request->isMethod('GET'))
        {
            $lotteries = Lottery::find($request->lotto_id);
            return response()->json($lotteries);
        }

        if($request->isMethod('POST'))
        {
            $request->validate([
                'country_id' => 'sometimes|numeric',
                'name' => 'required|unique:lotteries,name,'.$request['lotto_id']
            ]);

            $game = Lottery::find($request['lotto_id']);
            $game->name =  $request['name'];
            $game->country_id = $request['country_id'];
            $game->save();
            return response()->json(['success' => 'Lotto type has been updated!']);
        }
    }

    // public function deleteLotteryType(Request $request)
    // {
    //     if($request->isMethod('POST'))
    //     {
    //         $lottery_type_id = $request['lottery_type_id'];
    //         $lottery_type = LotteryType::findOrFail($lottery_type_id);
    //         $lottery_type->delete();
    //         return response()->json(['status' => true]);
    //     }
    // }
}
