<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function AllCat(){
        return view('admin.categoria.index');
    }
}
