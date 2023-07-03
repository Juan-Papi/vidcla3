<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    public function __construct()
    {
       $this->middleware('can:Listar bitacora')->only('index');
    }
    public function index()
    {
        return view('bitacora.index');
    }
}
