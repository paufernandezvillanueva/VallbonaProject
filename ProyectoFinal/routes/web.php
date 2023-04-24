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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//// USERS

Route::get('/user/list', [UserController::class, 'list'])->name('user_list')->middleware('auth');

Route::get('/user/profile', [UserController::class, 'profile'])->name('user_profile')->middleware('auth');

Route::post('/user/profile', [UserController::class, 'update'])->name('user_update')->middleware('auth');

Route::match(['get', 'post'], '/user/edit/{id}', [UserController::class, 'edit'])->name('user_edit')->middleware('auth');

Route::match(['get', 'post'], '/user/new', [UserController::class, 'new'])->name('user_new')->middleware('auth');

Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user_delete')->middleware('auth');

Route::match(['get', 'post'], '/user/detail/{id}', [UserController::class, 'detail'])->name('user_detail')->middleware('auth');

//// ESTADES

Route::get('/estada/list', [EstadaController::class, 'list'])->name('estada_list')->middleware('auth');

Route::match(['get', 'post'], '/estada/edit/{id}', [EstadaController::class, 'edit'])->name('estada_edit')->middleware('auth');

Route::match(['get', 'post'], '/estada/new', [EstadaController::class, 'new'])->name('estada_new')->middleware('auth');

Route::get('/estada/delete/{id}', [EstadaController::class, 'delete'])->name('estada_delete')->middleware('auth');

Route::match(['get', 'post'], '/estada/detail/{id}', [EstadaController::class, 'detail'])->name('estada_detail')->middleware('auth');

//// CICLES

Route::get('/cicle/list', [CicleController::class, 'list'])->name('cicle_list')->middleware('auth');

Route::match(['get', 'post'], '/cicle/edit/{id}', [CicleController::class, 'edit'])->name('cicle_edit')->middleware('auth');

Route::match(['get', 'post'], '/cicle/new', [CicleController::class, 'new'])->name('cicle_new')->middleware('auth');

Route::get('/cicle/delete/{id}', [CicleController::class, 'delete'])->name('cicle_delete')->middleware('auth');

//// EMPRESES

Route::get('/', [EmpresaController::class, 'list'])->name('empresa_list')->middleware('auth');
// Route::get('/empresa/list', [EmpresaController::class, 'list'])->name('empresa_list');

Route::match(['get', 'post'], '/empresa/edit/{id}', [EmpresaController::class, 'edit'])->name('empresa_edit')->middleware('auth');

Route::match(['get', 'post'], '/empresa/new', [EmpresaController::class, 'new'])->name('empresa_new')->middleware('auth');

Route::get('/empresa/delete/{id}', [EmpresaController::class, 'delete'])->name('empresa_delete')->middleware('auth');

Route::match(['get', 'post'], '/empresa/detail/{id}', [EmpresaController::class, 'detail'])->name('empresa_detail')->middleware('auth');

//// POBLACIONS

Route::get('/poblacio/list', [PoblacioController::class, 'list'])->name('poblacio_list')->middleware('auth');

Route::match(['get', 'post'], '/poblacio/edit/{id}', [PoblacioController::class, 'edit'])->name('poblacio_edit')->middleware('auth');

Route::match(['get', 'post'], '/poblacio/new', [PoblacioController::class, 'new'])->name('poblacio_new')->middleware('auth');

Route::get('/poblacio/delete/{id}', [PoblacioController::class, 'delete'])->name('poblacio_delete')->middleware('auth');

Route::match(['get', 'post'], '/poblacio/detail/{id}', [PoblacioController::class, 'detail'])->name('poblacio_detail')->middleware('auth');

////COMARCAS

Route::get('/comarca/list', [ComarcaController::class, 'list'])->name('comarca_list')->middleware('auth');

Route::match(['get', 'post'], '/comarca/edit/{id}', [ComarcaController::class, 'edit'])->name('comarca_edit')->middleware('auth');

Route::match(['get', 'post'], '/comarca/new', [ComarcaController::class, 'new'])->name('comarca_new')->middleware('auth');

Route::get('/comarca/delete/{id}', [ComarcaController::class, 'delete'])->name('comarca_delete')->middleware('auth');

Route::match(['get', 'post'], '/comarca/detail/{id}', [ComarcaController::class, 'detail'])->name('comarca_detail')->middleware('auth');

////ROL

Route::get('/rol/list', [RolController::class, 'list'])->name('rol_list')->middleware('auth');

Route::match(['get', 'post'], '/rol/edit/{id}', [RolController::class, 'edit'])->name('rol_edit')->middleware('auth');

Route::match(['get', 'post'], '/rol/new', [RolController::class, 'new'])->name('rol_new')->middleware('auth');

Route::get('/rol/delete/{id}', [RolController::class, 'delete'])->name('rol_delete')->middleware('auth');

Route::match(['get', 'post'], '/rol/detail/{id}', [RolController::class, 'detail'])->name('rol_detail')->middleware('auth');

//// CONTACTES

Route::get('/contacte/list', [ContacteController::class, 'list'])->name('contacte_list')->middleware('auth');

Route::match(['get', 'post'], '/contacte/edit/{id}', [ContacteController::class, 'edit'])->name('contacte_edit')->middleware('auth');

Route::match(['get', 'post'], '/contacte/new', [ContacteController::class, 'new'])->name('contacte_new')->middleware('auth');

Route::get('/contacte/delete/{id}', [ContacteController::class, 'delete'])->name('contacte_delete')->middleware('auth');

Route::match(['get', 'post'], '/contacte/detail/{id}', [ContacteController::class, 'detail'])->name('contacte_detail')->middleware('auth');

//// CURSOS

Route::get('/curs/list', [CursController::class, 'list'])->name('curs_list')->middleware('auth');

Route::match(['get', 'post'], '/curs/edit/{id}', [CursController::class, 'edit'])->name('curs_edit')->middleware('auth');

Route::match(['get', 'post'], '/curs/new', [CursController::class, 'new'])->name('curs_new')->middleware('auth');

Route::get('/curs/delete/{id}', [CursController::class, 'delete'])->name('curs_delete')->middleware('auth');

Route::match(['get', 'post'], '/curs/detail/{id}', [CursController::class, 'detail'])->name('curs_detail')->middleware('auth');

require __DIR__.'/auth.php';
