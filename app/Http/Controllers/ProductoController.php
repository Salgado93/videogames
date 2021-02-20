<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Carbon;

class ProductoController extends Controller
{
    public function AllProd(){
        $productos = Producto::latest()->paginate(5);
        return view('admin.producto.index', compact('productos'));
    }
    public function AgregarProducto(Request $request){
        $validated = $request->validate([
            'producto_nombre' => 'required|unique:productos|min:4',
            'producto_imagen' => 'required|mimes:jpg,jpeg,png',
        ],
        [
            'producto_nombre.required' => 'Porfavor escriba el nombre del producto.',
            'producto_imagen.min' => 'Producto mayor que 4 caracteres.'
        ]);
        $producto_imagen = $request->file('producto_imagen');
        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($producto_imagen->getClientOriginalExtension());
        $img_name = $name_gen.'.'.$img_ext;
        $up_location = 'image/producto/';
        $last_img = $up_location.$img_name;
        $producto_imagen->move($up_location,$img_name);
        
        Producto::insert([
            'producto_nombre' => $request->producto_nombre,
            'producto_imagen' => $last_img,
            'created_at' => Carbon::now()
        ]);
        return Redirect()->back()->with('success','Producto Guardado Exitosamente');
    }
}
