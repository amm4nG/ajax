<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function index()
    {
        $data = Data::all();
        // dd($data);
        return view('welcome', compact(['data']));
    }

    public function store(Request $request)
    {
        $data = new Data();
        $data->name = $request->name;
        $data->save();
        return response()->json($data);
    }
}