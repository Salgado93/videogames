<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function AllCat(){
        $categorias = DB::table('categorias')
                    ->join('users','categorias.user_id','users.id')
                    ->select('categorias.*','users.name')
                    ->latest()->paginate(5);
        
        //$categorias = Categoria::latest()->get();
        //$categorias = DB::table('categorias')->latest()->paginate(5);
        return view('admin.categoria.index', compact('categorias'));
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
    /*Categoria::insert([
        'nombre_categoria' => $request->nombre_categoria,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now()
    ]);*/
    //Sin hacer campo created_at.
    /*$categoria = new Categoria;
    $categoria->nombre_categoria = $request->nombre_categoria;
    $categoria->user_id = Auth::user()->id;
    $categoria->save();*/
    $data = array(); //Query Builder
    $data['nombre_categoria'] = $request->nombre_categoria;
    $data['user_id'] = Auth::user()->id;
    DB::table('categorias')->insert($data);
    return Redirect()->back()->with('success','Categoría Guardada Exitosamente.');
    }
}
