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
        //$categorias = DB::table('categorias')
        //            ->join('users','categorias.user_id','users.id')
        //            ->select('categorias.*','users.name')
        //            ->latest()->paginate(5);

        $categorias = Categoria::latest()->paginate(5);
        $trashCat = Categoria::onlyTrashed()->latest()->paginate(3);
        //$categorias = DB::table('categorias')->latest()->paginate(5);
        return view('admin.categoria.index', compact('categorias', 'trashCat'));
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
    //$data = array(); //Query Builder
    //$data['nombre_categoria'] = $request->nombre_categoria;
    //$data['user_id'] = Auth::user()->id;
    //DB::table('categorias')->insert($data);
    return Redirect()->back()->with('success','Categoría Guardada Exitosamente');
    }

    public function Editar($id){
        //$categorias = Categoria::find($id);
        $categorias = DB::table('categorias')->where('id',$id)->first();
        return view('admin.categoria.editar', compact('categorias'));
    }
    public function Actualizar(Request $request, $id){
        /*$actualizar = Categoria::find($id)->actualizar([
            'nombre_categoria' => $request->nombre_categoria,
            'user_id' => Auth::user()->id
        ]);*/
        //Query Builder
        $data = array();
        $data['nombre_categoria'] = $request->nombre_categoria;
        $data['user_id'] = Auth::user()->id;
        DB::table('categorias')->where('id',$id)->update($data);
        return Redirect()->route('all.category')->with('success','Categoría Actualizada Exitosamente');

    }
    public function SoftDelete($id){
        $delete = Categoria::find($id)->delete();
        return Redirect()->back()->with('success','Categoría Eliminada Exitosamente');
    }
    public function Restore($id){
        $delete = Categoria::withTrashed()->find($id)->restore();
        return Redirect()->back()->with('success','Categoría Restaurada Exitosamente');
    }
    public function Pdelete($id){
        $delete = Categoria::onlyTrashed()->find($id)->forceDelete();
        return Redirect()->back()->with('success','Categoría Eliminada Permanente');
    }
}
