<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoblacioController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list() 
    { 
        $poblacions = Poblacio::all();

        return view('poblacio.list', ['poblacions' => $poblacions]);
    }
    
    function new(Request $request) 
    {
        if ($request->isMethod('post')) {   
            $poblacio = new Poblacio;
            $poblacio->name = $request->name;
            $poblacio->comarca_id = $request->comarca_id;
            $poblacio->save();

            return redirect()->route('poblacio_list');
        }

        return view('poblacio.new');
    }

    function edit(Request $request, $id) 
    { 
        if ($request->isMethod('post')) {   
            $poblacio = new Poblacio;
            $poblacio->name = $request->name;
            $poblacio->comarca_id = $request->comarca_id;
            $poblacio->save();

            return redirect()->route('poblacio_list');
        }      
        $poblacio = Poblacio::find($id);

        return view('poblacio.edit', ['poblacio' => $poblacio]);
    }

    function delete($id) 
    { 
        $poblacio = Poblacio::find($id);
        $poblacio->delete();

        return redirect()->route('poblacio_list');
    }
}
