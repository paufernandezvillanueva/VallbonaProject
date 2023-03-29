<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Empresa;

class EmpresaController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function list()
  {
    $empresas = Empresa::all();

    return view('empresa.list', ['empresas' => $empresas]);
  }

  function edit(Request $request, $id)
  {
    $empresa = Empresa::find($id);
    if ($request->isMethod('post')) {
      // recollim els camps del formulari en un objecte empresa

      //$empresa = new Empresa;
      $empresa->cif = $request->cif;
      $empresa->name = $request->name;
      $empresa->sector = $request->sector;
      $empresa->comarca_id = $request->comarca_id;
      $empresa->poblacio_id = $request->poblacio_id;
      $empresa->contacte_id = $request->contacte_id;
      $empresa->save();

      return redirect()->route('empresa_list')->with('status', 'Empresa ' . $empresa->name . ' modificada!');
    }
    // si no venim de fer submit al formulari, hem de mostrar el formulari

    $empresas = Empresa::all();

    return view('empresa.edit', ['empresas' => $empresas, 'empresa' => $empresa]);
  }

  function new(Request $request)
  {
    if ($request->isMethod('post')) {
      // recollim els camps del formulari en un objecte empresa

      $empresa = new Empresa;
      $empresa->cif = $request->cif;
      $empresa->name = $request->name;
      $empresa->sector = $request->sector;
      $empresa->comarca_id = $request->comarca_id;
      $empresa->poblacio_id = $request->poblacio_id;
      $empresa->contacte_id = $request->contacte_id;
      $empresa->save();

      return redirect()->route('empresa_list')->with('status', 'Nou empresa ' . $empresa->name . ' creada!');
    }
    // si no venim de fer submit al formulari, hem de mostrar el formulari

    $empresas = Empresa::all();

    return view('empresa.new', ['empresas' => $empresas]);
  }

  function delete($id)
  {
    $empresa = Empresa::find($id);
    $empresa->delete();

    return redirect()->route('empresa_list')->with('status', 'Empresa ' . $empresa->name . ' eliminada!');
  }
}
