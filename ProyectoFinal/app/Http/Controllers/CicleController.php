<?php

namespace App\Http\Controllers;

use App\Models\Cicle;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CicleController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list()
    {
        $cicles = Cicle::all();
        return view('cicle.list', ['cicles' => $cicles]);
    }
    function new(Request $request)
    {
        if ($request->isMethod('post')) {

            // recollim els camps del formulari en un objecte cicle
            $cicle = new Cicle;
            $cicle->shortname = $request->shortname;
            $cicle->name = $request->name;
            $cicle->save();
            return redirect()->route('cicle_list')->with('status', 'Cicle '.$cicle->shortname. ' ' .$cicle->name.' creat!');
        }
        // si no venim de fer submit al formulari, hem de mostrar el formulari

        $cicles = Cicle::all();

        return view('cicle.new', ['cicles' => $cicles]);
    }

    function edit(Request $request, $id)
    {
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
    }
    function delete($id){
        $cicle = Cicle::find($id);
        $cicle->delete();
        return redirect()->route('cicle_list')->with('status', 'Cicle'.$cicle->nom.' '.$cicle->shortname. ' eliminat!');
    }
}
