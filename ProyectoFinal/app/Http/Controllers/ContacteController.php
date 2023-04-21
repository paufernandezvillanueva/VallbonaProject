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
        $empresas = Empresa::all();

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

        $contactes = $contactes->distinct("contactes.*")->get("contactes.*");

        return view('contacte.list', ['contactes' => $contactes, 'empresas' => $empresas, 'request' => $request ]);
    }

    function detail(Request $request, $id)
    {
        $contacte = Contacte::find($id);
        $nomEmpresa = Empresa::where("id", "=", $contacte->empresa_id)->first("name");
        $empresas = Empresa::all();

        return view('contacte.detail', ['contacte' => $contacte, 'nomEmpresa' => $nomEmpresa, 'empresas' => $empresas]);
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

            return redirect()->route('contacte_list');
        }
        $empresas = Empresa::all();
        return view('contacte.new', ['empresas'=>$empresas]);
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

            return redirect()->route('contacte_list');
        }
        $contacte = Contacte::find($id);

        return view('contacte.edit', ['contacte' => $contacte, 'empresas' => $empresas]);
    }

    function delete($id)
    {
        $contacte = Contacte::find($id);
        $contacte->delete();

        return redirect()->route('contacte_list');
    }
}
