<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ProveedoresActivosController extends Controller
{
    public function index(){
        $sql = DB::select("SELECT * from proveedores where estado = 0 or estado = 1");
        return view("ProveedoresActivos")->with("proveedores",$sql);
    }

}
