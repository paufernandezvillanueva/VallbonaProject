<?php

namespace App\Http\Controllers;

use App\Models\Comarca;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class ComarcaController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list(Request $request)
    {
        if (Auth::user()->rol_id == 5076) {
            $comarcas = Comarca::join("poblacios", "comarcas.id", "=", "poblacios.comarca_id");

            if (isset($request->name)) {
                if ($request->name != "") {
                  $comarcas = $comarcas->where('comarcas.name', 'like', "%" . $request->name . "%");
                }
            }

            $comarcas = $comarcas->distinct("comarcas.*")->get("comarcas.*");
            return view('comarca.list', ['comarcas' => $comarcas, 'request' => $request]);
        } else {
            return redirect('');
        }
    }
    
    function detail(Request $request, $id)
    {
        if (Auth::user()->rol_id == 5076) {
            $comarca = Comarca::find($id);

            return view('comarca.detail', ['comarca' => $comarca]);
        } else {
            return redirect('');
        }
    }

    function new(Request $request)
    {
        if (Auth::user()->rol_id == 5076) {
            if ($request->isMethod('post')) {

                // recollim els camps del formulari en un objecte comarca
                $comarca = new Comarca;
                $comarca->name = $request->name;
                $comarca->save();
                return redirect()->route('comarca_list');
            }
            // si no venim de fer submit al formulari, hem de mostrar el formulari

            $comarcas = Comarca::all();

            return view('comarca.new', ['comarcas' => $comarcas]);
        } else {
            return redirect('');
        }
    }

    function edit(Request $request, $id)
    {
        if (Auth::user()->rol_id == 5076) {
            $comarca = Comarca::find($id);
            if ($request->isMethod('post')){
                //Recollir camps objecte comarca
                $comarca->name = $request->name;
                $comarca->save();

                return redirect()->route('comarca_list');
            }
            $comarcas = Comarca::all();
            return view('comarca.list', ['comarcas' => $comarcas]);
        } else {
            return redirect('');
        }
    }
    function delete($id){
        if (Auth::user()->rol_id == 5076) {
            $comarca = Comarca::find($id);
            $comarca->delete();
            return redirect()->route('comarca_list');
        } else {
            return redirect('');
        }
    }
}
