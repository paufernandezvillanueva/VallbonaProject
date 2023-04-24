<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Rol;

class RolController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list(Request $request)
    {
        if (Auth::user()->rol_id == 5076) {
            $rols = Rol::join("users", "rols.id", "=", "users.rol_id");

            if (isset($request->name)) {
                if ($request->name != "") {
                    $rols = $rols->where('rols.name', 'like', "%" . $request->name . "%");
                }
            }

            $rols = $rols->distinct("rols.*")->get("rols.*");

            return view('rol.list', ['rols' => $rols, 'request' => $request]);
        } else {
            return redirect('');
        }
    }

    function detail(Request $request, $id)
    {
        $rol = Rol::find($id);

        return view('rol.detail', ['rol' => $rol]);
    }

    function new(Request $request)
    {
        if (Auth::user()->rol_id == 5076) {
            if ($request->isMethod('post')) {
                $rol = new Rol;
                $rol->name = $request->name;
                $rol->save();
                return redirect()->route('rol_list');
            }
            $rols = Rol::all();
            return view('rol.new', ['rols' => $rols]);
        } else {
            return redirect('');
        }
    }

    function edit(Request $request, $id)
    {
        if (Auth::user()->rol_id == 5076) {
            $rol = Rol::find($id);
            if ($request->isMethod('post')) {
                $rol->name = $request->name;
                $rol->save();
                return redirect()->route('rol_detail', ['id' => $id]);
            }
            $rols = Rol::all();
            return view('rol.edit', ['rols' => $rols, 'rol' => $rol]);
        } else {
            return redirect('');
        }
    }
    
    function delete($id)
    {
        if (Auth::user()->rol_id == 5076) {
            $rol = Rol::find($id);
            $rol->delete();
            return redirect()->route('rol_list');
        } else {
            return redirect('');
        }
    }
}
