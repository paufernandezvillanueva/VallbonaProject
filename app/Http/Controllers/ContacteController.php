<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Contacte;
use App\Models\Empresa;

class ContacteController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list(Request $request)
    {
        $contactes = Contacte::join("empresas", "empresas.id", '=', 'contactes.empresa_id');
        $empresas = Empresa::orderBy('name', 'asc')->get();

        if (isset($request->name)) {
            if ($request->name != "") {
              $contactes = $contactes->where('contactes.name', 'like', "%" . $request->name . "%");
            }
        }

        if (isset($request->empresa)) {
            if ($request->empresa != "") {
              $contactes = $contactes->where('empresas.name', 'like', "%" . $request->empresa . "%");
            }
        }

        $contactes = $contactes->distinct("contactes.*")->orderBy('contactes.name', 'asc')->get("contactes.*");

        return view('contacte.list', ['contactes' => $contactes, 'empresas' => $empresas, 'request' => $request ]);
    }

    function detail(Request $request, $id)
    {
        $contacte = Contacte::find($id);
        if (!isset($contacte->id)) {
            return redirect()->route('contacte_list');
        }
        $empresas = Empresa::orderBy('name', 'asc')->get();

        return view('contacte.detail', ['contacte' => $contacte, 'empresas' => $empresas]);
    }

    function import(Request $request)
    {
        $file = fopen($_FILES["csv"]["tmp_name"], "r");
        $all_data = array();
        while (($data = fgetcsv($file, 0, ",")) !== FALSE ) {
        if ($data[3] != "name") {
            $contacte = new Contacte;
            $contacte->name = $data[3];
            $contacte->empresa_id = $data[4];
            $contacte->email = $data[5];
            $contacte->phonenumber = $data[6];
            $contacte->save();
        }
        }
        
        return redirect()->route('contacte_list');
    }
    
    function new(Request $request)
    {
        if ($request->isMethod('post')) {
            $contacte = new Contacte;
            $contacte->name = $request->name;
            $contacte->empresa_id = $request->empresa_id;
            $contacte->email = $request->email;
            $contacte->phonenumber = $request->phonenumber;
            $contacte->save();
    
            if ($request->input('redirect_to') == 'empresa_detail') {
                return redirect()->route('empresa_detail', ['id' => $contacte->empresa_id]);
            } else if ($request->input('redirect_to') == 'contacte_list') {
                return redirect()->route('contacte_list');
            }
        }
    }

    function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $contacte = Contacte::find($id);
            $contacte->name = $request->name;
            $contacte->empresa_id = $request->empresa_id;
            $contacte->email = $request->email;
            $contacte->phonenumber = $request->phonenumber;
            $contacte->save();

            return redirect()->route('contacte_detail', ['id' => $id]);
        }
    }

    function delete($id)
    {
        $contacte = Contacte::find($id);
        $contacte->delete();

        return redirect()->route('contacte_list');
    }
}
