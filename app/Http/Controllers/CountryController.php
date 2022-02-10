<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function countries()
    {
        return Country::all();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|alpha|min:2|max:2|unique:countries,name'
        ]);

        Country::create($request->all());

        return response()->json(['success' => 'Country has been created']);
    }

    public function update(Request $request)
    {
        if($request->isMethod('GET'))
        {
            $country = Country::find($request->country_id);
            return response()->json($country);
        }

        if($request->isMethod('POST'))
        {
            $request->validate([
                'name' => 'required|alpha|min:2|max:2|unique:countries,name,'.$request->country_id,
            ]);

            $country = Country::findOrFail($request->country_id);
            $country->name = $request->country;
            $country->save();
            return response()->json(['success' => 'Country has been updated!']);
        }
    }

    public function delete(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $country = Country::findOrFail($request->country_id);
            $country->delete();
            return response()->json(['success' => 'Country has been deleted!']);
        }
    }
}
