<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        $datos = DB::select("select * from ventas");
        return view("ventas")->with("datos", $datos);
    }
}
