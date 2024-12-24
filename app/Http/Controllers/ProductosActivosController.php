<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductosActivosController extends Controller
{
   public function index(){
    $sql = DB::select(query: "SELECT * from producto where estado = 1 or estado = 0");
    return view("ProductosActivos")->with("producto",$sql);
}


}
