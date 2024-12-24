<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class ReporteController extends Controller
{
    public function index()
    {
        $sql = DB::select(query: "SELECT * from producto");
        return view("ReporteView")->with("producto",$sql);

    }


}

