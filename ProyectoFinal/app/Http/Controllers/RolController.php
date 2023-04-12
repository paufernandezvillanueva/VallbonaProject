<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

use App\Models\Rol;
class RolController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list()
    {
        $rols = Rol::all();
        return view('rol.list', ['rols'=>$rols]);
    }

    function new (Request $request)
    {
        if ($request->isMethod('post')){
            $rol = new Rol;
            $rol->name = $request->name;
            $rol->save();
            return redirect()->route('rol_list');
        }
        $rols = Rol::all();
        return view('rol.new', ['rols' => $rols]);
    }

    function edit(Request $request, $id)
    {
        $rol = Rol::find($id);
        if($request->isMethod('post')){
            $rol->name = $request->name;
            $rol->save();
            return redirect()->route('user_list');
        }
        $rols = Rol::all();
        return view('rol.edit', ['rols'=>$rols, 'rol'=>$rol]);
    }
    function delete($id)
    {
        $rol = Rol::find($id);
        $rol->delete();
        return redirect()->route('rol_list');
    }
}
