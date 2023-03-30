<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CicleController;
use App\Http\Controllers\ComarcaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PoblacioController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', function (){
    return view('default.home');
});

Route::get('/', [DefaultController::class, 'home'])->name('home');

//// USERS

Route::get('/user/list', [UserController::class, 'list'])->name('user_list');

Route::match(['get', 'post'], '/user/edit/{id}', [UserController::class, 'edit'])->name('user_edit');

Route::match(['get', 'post'], '/user/new', [UserController::class, 'new'])->name('user_new');

Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user_delete');



//// CICLES

Route::get('/cicles/list', [CicleController::class, 'list'])->name('cicle_list');

Route::match(['get', 'post'], '/cicle/edit/{id}', [CicleController::class, 'edit'])->name('cicle_edit');

Route::match(['get', 'post'], '/cicle/new', [CicleController::class, 'new'])->name('cicle_new');

Route::get('/cicle/delete/{id}', [CicleController::class, 'delete'])->name('cicle_delete');

//// EMPRESES

Route::get('/empresa/list', [EmpresaController::class, 'list'])->name('empresa_list');

Route::match(['get', 'post'], '/empresa/edit/{id}', [EmpresaController::class, 'edit'])->name('empresa_edit');

Route::match(['get', 'post'], '/empresa/new', [EmpresaController::class, 'new'])->name('empresa_new');

Route::get('/empresa/delete/{id}', [EmpresaController::class, 'delete'])->name('empresa_delete');

//// POBLACIONS

Route::get('/poblacions/list', [PoblacioController::class, 'list'])->name('poblacio_list');

Route::match(['get', 'post'], '/poblacions/edit/{id}', [PoblacioController::class, 'edit'])->name('poblacio_edit');

Route::match(['get', 'post'], '/poblacions/new', [PoblacioController::class, 'new'])->name('poblacio_new');

Route::get('/poblacions/delete/{id}', [PoblacioController::class, 'delete'])->name('poblacio_delete');

////COMARCAS

Route::get('/comarcas/list', [ComarcaController::class, 'list'])->name('comarca_list');

Route::match(['get', 'post'], '/comarcas/edit/{id}', [ComarcaController::class, 'edit'])->name('comarca_edit');

Route::match(['get', 'post'], '/comarcas/new', [ComarcaController::class, 'new'])->name('comarca_new');

Route::get('/comarcas/delete/{id}', [ComarcaController::class, 'delete'])->name('comarca_delete');
