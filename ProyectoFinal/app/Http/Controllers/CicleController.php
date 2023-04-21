<?php

namespace App\Http\Controllers;

use App\Models\Cicle;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class CicleController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list(Request $request)
    {
        if (Auth::user()->rol_id == 5076) {
            $cicles = Cicle::join("users", "cicles.id", "=", "users.cicle_id");

            if (isset($request->name)) {
                if ($request->name != "") {
                  $cicles = $cicles->where('cicles.name', 'like', "%" . $request->name . "%");
                }
            }

            $cicles = $cicles->distinct("cicles.*")->get("cicles.*");
            
            return view('cicle.list', ['cicles' => $cicles, 'request' => $request]);
        } else {
            return redirect('');
        }
    }
    function new(Request $request)
    {
        if (Auth::user()->rol_id == 5076) {
            if ($request->isMethod('post')) {

                // recollim els camps del formulari en un objecte cicle
                $cicle = new Cicle;
                $cicle->shortname = $request->shortname;
                $cicle->name = $request->name;
                $cicle->save();
                return redirect()->route('cicle_list')->with('status', 'Cicle ' . $cicle->shortname . ' ' .$cicle->name.' creat!');
            }
            // si no venim de fer submit al formulari, hem de mostrar el formulari

            $cicles = Cicle::all();

            return view('cicle.new', ['cicles' => $cicles]);
        } else {
            return redirect('');
        }
    }

    function edit(Request $request, $id)
    {
        if (Auth::user()->rol_id == 5076) {
            $cicle = Cicle::find($id);
            if ($request->isMethod('post')){
                //Recollir camps objecte cicle
                $cicle->shortname = $request->shortname;
                $cicle->name = $request->name;
                $cicle->save();

                return redirect()->route('cicle_list');
            }
            $cicles = Cicle::all();
            return view('cicle.edit', ['cicle' => $cicle]);
        } else {
            return redirect('');
        }
    }
    function delete($id){
        if (Auth::user()->rol_id == 5076) {
            $cicle = Cicle::find($id);
            $cicle->delete();
            return redirect()->route('cicle_list')->with('status', 'Cicle'.$cicle->nom.' '.$cicle->shortname. ' eliminat!');
        } else {
            return redirect('');
        }
    }
}
