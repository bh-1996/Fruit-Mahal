<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;



class DropdownController extends Controller
{
    //
    public function index()
    {
        $data['countris'] = DB::get(["name", "id"]);
        return view('signup',$data);
    }

    public function fetchState(Request $request)
    {
        $data['states'] = DB::where("country_id",$request->country_id)->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchCity(Request $request)
    {
        $data['cities'] = DB::where("state_id",$request->state_id)->get(["name", "id"]);
        return response()->json($data);
    }
}
