<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Curs;

class CursController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
        if (Auth::user()->rol_id == 5076) {
            $cursos = Curs::all();

            return view('curs.list', ['cursos' => $cursos]);
        } else {
        return redirect('');
        }
    }
    
    function new(Request $request) 
    {
        if (Auth::user()->rol_id == 5076) {
            if ($request->isMethod('post')) {   
                $curs = new Curs;
                $curs->name = $request->name;
                $curs->save();

                return redirect()->route('curs_list');
            }

            return view('curs.new');
        } else {
        return redirect('');
        }
    }

    function edit(Request $request, $id) 
    { 
        if (Auth::user()->rol_id == 5076) {
            if ($request->isMethod('post')) {   
                $curs = Curs::find($id);
                $curs->name = $request->name;
                $curs->save();

                return redirect()->route('curs_list');
            }
            // si no venim de fer submit al formulari, hem de mostrar el formulari

            $curs = Curs::find($id);

            return view('curs.edit', ['curs' => $curs]);
        } else {
        return redirect('');
        }
    }

    function delete($id) 
    {
        if (Auth::user()->rol_id == 5076) {
            $curs = Curs::find($id);
            $curs->delete();

            return redirect()->route('curs_list');
        } else {
        return redirect('');
        }
    }
}
