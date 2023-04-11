<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Empresa;
use App\Models\Poblacio;
use App\Models\Contacte;

class EmpresaController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function list(Request $request)
  {
    $empresas = Empresa::join('poblacios', 'empresas.poblacio_id', '=', 'poblacios.id')->
    join('comarcas', 'poblacios.comarca_id', '=', 'comarcas.id')->
    leftjoin('estadas', 'empresas.id', '=', 'estadas.empresa_id');

    if (isset($request->cif)) {
      if ($request->cif != "") {
        $empresas = $empresas->where('empresas.cif', 'like', '%' . $request->cif . '%');
      }
    }

    if (isset($request->name)) {
      if ($request->name != "") {
        $empresas = $empresas->where('empresas.name', 'like', '%' . $request->name . '%');
      }
    }

    if (isset($request->cicle)) {
      if ($request->cicle != 0) {
        $empresas = $empresas->where('estadas.cicle_id', '=', $request->cicle);
      }
    }

    if (isset($request->sector)) {
      if ($request->sector != "") {
        $empresas = $empresas->where('empresas.sector', 'like', '%' . $request->sector . '%');
      }
    }

    if (isset($request->comarca)) {
      if ($request->comarca != 0) {
        $empresas = $empresas->where('comarcas.id', '=', $request->comarca);
      }
    }

    if (isset($request->poblacio)) {
      if ($request->poblacio != 0) {
        $empresas = $empresas->where('poblacios.id', '=', $request->poblacio);
      }
    }

    $empresas = $empresas->get("empresas.*");

    return view('empresa.list', ['empresas' => $empresas]);
  }

  function detail(Request $request, $id)
  {
    $empresa = Empresa::find($id);
    $poblacio = Poblacio::find($empresa->poblacio_id);
    $contactes = Contacte::all()->where('empresa_id', '=', $empresa->id);

    return view('empresa.detail', ['empresa' => $empresa, "poblacio" => $poblacio, "contactes" => $contactes]);
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
      $empresa->poblacio_id = $request->poblacio_id;
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
      $empresa->poblacio_id = $request->poblacio_id;
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
