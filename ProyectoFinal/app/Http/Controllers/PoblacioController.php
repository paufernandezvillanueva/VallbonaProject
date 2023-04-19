<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Poblacio;
use App\Models\Comarca;

class PoblacioController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list(Request $request) 
    { 
        if (Auth::user()->rol_id == 5076) {
            $poblacions = Poblacio::all();

            if (isset($request->comarca)) {
                if ($request->comarca != "") {
                  $poblacions = $poblacions->where('comarca_id', '=', $request->comarca);
                }
            }
            $comarques = Comarca::all();
              
            return view('poblacio.list', ['poblacions' => $poblacions, 'comarques' => $comarques]);
        } else {
            return redirect('');
        }
    }
    
    function detail(Request $request, $id)
    {
        if (Auth::user()->rol_id == 5076) {
            $poblacio = Poblacio::find($id);
            $comarques = Comarca::all();

            return view('poblacio.detail', ['poblacio' => $poblacio, 'comarques' => $comarques]);
        } else {
            return redirect('');
        }
    }
    
    function new(Request $request) 
    {
        if (Auth::user()->rol_id == 5076) {
            if ($request->isMethod('post')) {   
                $poblacio = new Poblacio;
                $poblacio->name = $request->name;
                $poblacio->comarca_id = $request->comarca_id;
                $poblacio->save();

                return redirect()->route('poblacio_list');
            }
            $comarques = Comarca::all();

            return view('poblacio.new', ['comarques' => $comarques]);
        } else {
            return redirect('');
        }
    }

    function edit(Request $request, $id) 
    { 
        if (Auth::user()->rol_id == 5076) {
            if ($request->isMethod('post')) {   
                $poblacio = Poblacio::find($id);
                $poblacio->name = $request->name;
                $poblacio->comarca_id = $request->comarca_id;
                $poblacio->save();

                return redirect()->route('poblacio_list');
            }      
            $poblacio = Poblacio::find($id);
            $comarques = Comarca::all();

            return view('poblacio.edit', ['poblacio' => $poblacio, 'comarques' => $comarques]);
        } else {
            return redirect('');
        }
    }

    function delete($id) 
    { 
        if (Auth::user()->rol_id == 5076) {
            $poblacio = Poblacio::find($id);
            $poblacio->delete();

            return redirect()->route('poblacio_list');
        } else {
            return redirect('');
        }
    }
}
