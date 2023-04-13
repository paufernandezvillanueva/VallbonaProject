<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DefaultController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CicleController;
use App\Http\Controllers\ComarcaController;
use App\Http\Controllers\ContacteController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PoblacioController;
use App\Http\Controllers\EstadaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\CursController;



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

// Route::get('/home', function (){
//     return view('default.home');
// });

// Route::get('/', [DefaultController::class, 'home'])->name('home');

//// USERS

Route::get('/user/list', [UserController::class, 'list'])->name('user_list');

Route::match(['get', 'post'], '/user/edit/{id}', [UserController::class, 'edit'])->name('user_edit');

Route::match(['get', 'post'], '/user/new', [UserController::class, 'new'])->name('user_new');

Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user_delete');

//// ESTADES

Route::get('/estada/list', [EstadaController::class, 'list'])->name('estada_list');

Route::match(['get', 'post'], '/estada/edit/{id}', [EstadaController::class, 'edit'])->name('estada_edit');

Route::match(['get', 'post'], '/estada/new', [EstadaController::class, 'new'])->name('estada_new');

Route::get('/estada/delete/{id}', [EstadaController::class, 'delete'])->name('estada_delete');

//// CICLES

Route::get('/cicles/list', [CicleController::class, 'list'])->name('cicle_list');

Route::match(['get', 'post'], '/cicle/edit/{id}', [CicleController::class, 'edit'])->name('cicle_edit');

Route::match(['get', 'post'], '/cicle/new', [CicleController::class, 'new'])->name('cicle_new');

Route::get('/cicle/delete/{id}', [CicleController::class, 'delete'])->name('cicle_delete');

//// EMPRESES

Route::get('/', [EmpresaController::class, 'list'])->name('empresa_list');
// Route::get('/empresa/list', [EmpresaController::class, 'list'])->name('empresa_list');

Route::match(['get', 'post'], '/empresa/edit/{id}', [EmpresaController::class, 'edit'])->name('empresa_edit');

Route::match(['get', 'post'], '/empresa/new', [EmpresaController::class, 'new'])->name('empresa_new');

Route::get('/empresa/delete/{id}', [EmpresaController::class, 'delete'])->name('empresa_delete');

Route::match(['get', 'post'], '/empresa/detail/{id}', [EmpresaController::class, 'detail'])->name('empresa_detail');

//// POBLACIONS

Route::get('/poblacions/list', [PoblacioController::class, 'list'])->name('poblacio_list');

Route::match(['get', 'post'], '/poblacions/edit/{id}', [PoblacioController::class, 'edit'])->name('poblacio_edit');

Route::match(['get', 'post'], '/poblacions/new', [PoblacioController::class, 'new'])->name('poblacio_new');

Route::get('/poblacions/delete/{id}', [PoblacioController::class, 'delete'])->name('poblacio_delete');

////COMARCAS

Route::get('/comarcas/list', [ComarcaController::class, 'list'])->name('comarca_list');

Route::match(['get', 'post'], '/comarca/edit/{id}', [ComarcaController::class, 'edit'])->name('comarca_edit');

Route::match(['get', 'post'], '/comarca/new', [ComarcaController::class, 'new'])->name('comarca_new');

Route::get('/comarca/delete/{id}', [ComarcaController::class, 'delete'])->name('comarca_delete');

////ROL

Route::get('/rols/list', [RolController::class, 'list'])->name('rol_list');

Route::match(['get', 'post'], '/rol/edit/{id}', [RolController::class, 'edit'])->name('rol_edit');

Route::match(['get', 'post'], '/rol/new', [RolController::class, 'new'])->name('rol_new');

Route::get('/rol/delete/{id}', [RolController::class, 'delete'])->name('rol_delete');

//// CONTACTES

Route::get('/contacte/list', [ContacteController::class, 'list'])->name('contacte_list');

Route::match(['get', 'post'], '/contacte/edit/{id}', [ContacteController::class, 'edit'])->name('contacte_edit');

Route::match(['get', 'post'], '/contacte/new', [ContacteController::class, 'new'])->name('contacte_new');

Route::get('/contacte/delete/{id}', [ContacteController::class, 'delete'])->name('contacte_delete');

Route::match(['get', 'post'], '/contacte/detail/{id}', [ContacteController::class, 'detail'])->name('contacte_detail');

//// CURSOS

Route::get('/cursos/list', [CursController::class, 'list'])->name('curs_list');

Route::match(['get', 'post'], '/curs/edit/{id}', [CursController::class, 'edit'])->name('curs_edit');

Route::match(['get', 'post'], '/curs/new', [CursController::class, 'new'])->name('curs_new');

Route::get('/curs/delete/{id}', [CursController::class, 'delete'])->name('curs_delete');
