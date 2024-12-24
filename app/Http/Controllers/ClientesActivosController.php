<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ClientesActivosController extends Controller
{
   public function index(){
    $sql = db::select(query: "SELECT * FROM clientes WHERE estado = 1 or estado = 0");

    return view("ClientesActivos")->with('clientes', $sql);
   }
}
