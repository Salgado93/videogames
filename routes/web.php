<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contacto', [ContactoController::class, 'index'])->name('daniel');

Route::get('/categoria/all', [CategoriaController::class, 'AllCat'])->name('all.category');
Route::post('/categoria/add', [CategoriaController::class, 'AddCat'])->name('store.category');
Route::get('/categoria/editar/{id}', [CategoriaController::class, 'Editar']);
Route::post('/categoria/actualizar/{id}', [CategoriaController::class, 'Actualizar']);
Route::get('/softdelete/categoria/{id}', [CategoriaController::class, 'SoftDelete']);
Route::get('/categoria/restaurar/{id}', [CategoriaController::class, 'Restore']);
Route::get('/pdelete/categoria/{id}', [CategoriaController::class, 'Pdelete']);
Route::get('/producto/all', [ProductoController::class, 'AllProd'])->name('all.producto');
Route::post('/producto/add', [ProductoController::class, 'AgregarProducto'])->name('store.producto');
Route::get('/producto/editar/{id}', [ProductoController::class, 'Editar']);
Route::post('/producto/actualizar/{id}', [ProductoController::class, 'Actualizar']);
Route::get('/user/logout', [ProductoController::class, 'Logout'])->name('user.logout');




Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all();
    //$users = DB::table('users')->get();
    //return view('dashboard',compact('users'));
    return view('admin.index');
})->name('dashboard');
