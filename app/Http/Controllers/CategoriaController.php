<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Auth;
use Illuminate\Support\Carbon;

class CategoriaController extends Controller
{
    public function AllCat(){
        return view('admin.categoria.index');
    }

    public function AddCat(Request $request){
        $validated = $request->validate([
            'nombre_categoria' => 'required|unique:categorias|max:255',
        ],
        [
            'nombre_categoria.required' => 'Porfavor escriba el nombre de la categoría.',
            'nombre_categoria.max' => 'Categoría menor que 255 caracteres.'
        ]
    );
    Categoria::insert([
        'nombre_categoria' => $request->nombre_categoria,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now()
    ]);
    //Sin hacer campo created_at.
    /*$categoria = new Categoria;
    $categoria->nombre_categoria = $request->nombre_categoria;
    $categoria->user_id = Auth::user()->id;
    $categoria->save();*/
    return Redirect()->back()->with('success','Categoría Guardada Exitosamente.');
    }
}
