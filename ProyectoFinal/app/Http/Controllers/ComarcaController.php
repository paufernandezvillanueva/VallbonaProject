<?php

namespace App\Http\Controllers;

use App\Models\Comarca;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ComarcaController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list()
    {
        $comarcas = Comarca::all();
        return view('comarcas.list', ['comarcas'=>$comarcas]);
    }

    function new(Request $request)
    {
        if ($request->isMethod('post')) {

            // recollim els camps del formulari en un objecte comarca
            $comarca = new Comarca;
            $comarca->name = $request->name;
            $comarca->save();
            return redirect()->route('comarca_list')->with('status', 'Comarca '.$comarca->shortname. ' ' .$comarca->name.' creat!');
        }
        // si no venim de fer submit al formulari, hem de mostrar el formulari

        $comarcas = Comarca::all();

        return view('comarca.new', ['comarcas' => $comarcas]);
    }

    function edit(Request $request, $id)
    {
        $comarca = Comarca::find($id);
        if ($request->isMethod('post')){
            //Recollir camps objecte comarca
            $comarca->name = $request->name;
            $comarca->save();

            return redirect()->route('comarca_list')->with('status', 'Comarca'.$comarca->nom.' modificada!');
        }
        $comarcas = Comarca::all();
        return view('comarcas.list', ['comarcas' => $comarcas]);
    }
    function delete($id){
        $cicle = Comarca::find($id);
        $cicle->delete();
        return redirect()->route('comarca_list')->with('status', 'Comarca'.$cicle->nom.' eliminada!');
    }
}
