<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\Models\Empresa;
use App\Models\Poblacio;
use App\Models\Contacte;
use App\Models\Estada;
use App\Models\User;
use App\Models\Curs;
use App\Models\Cicle;
use App\Models\Comarca;

class EmpresaController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function list(Request $request)
  {
    if (Auth::user()->first_login == null) { 
      return redirect()->route('first_login', Auth::user()->id);
    } else {
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

      if (isset($request->minEstadas)) {
        if (!isset($request->maxEstadas) || $request->maxEstadas >= $request->minEstadas) {
          $empresas = $empresas->groupBy("empresas.id")->having(DB::raw('count(estadas.id)'), '>=', $request->minEstadas);
        }
      }

      if (isset($request->maxEstadas)) {
        $empresas = $empresas->groupBy("empresas.id")->having(DB::raw('count(estadas.id)'), '<=', $request->maxEstadas);
      }

      if (isset($request->minValoracio)) {
        if (!isset($request->maxValoracio) || $request->maxValoracio >= $request->minValoracio && $request->maxValoracio != "Ninguna") {
          $empresas = $empresas->groupBy("empresas.id")->having(DB::raw('avg(estadas.evaluation)'), '>=', $request->minValoracio);
        }
      }

      if (isset($request->maxValoracio)) {
        if ($request->maxValoracio != "Ninguna") {
          $empresas = $empresas->groupBy("empresas.id")->having(DB::raw('round(avg(estadas.evaluation), 1)'), '<=', $request->maxValoracio);
        } else {
          $empresas = $empresas->groupBy("empresas.id")->having(DB::raw('count(estadas.evaluation)'), '=', 0);
        }
      }

      $sectors = Empresa::orderBy('sector', 'asc')->distinct("sector")->get("sector");
      $empresas = $empresas->distinct("empresas.*")->orderBy('empresas.cif', 'asc')->orderBy('empresas.name', 'asc')->get("empresas.*");

      $cicles = Cicle::all();
      $comarques = Comarca::all();
      return view('empresa.list', ['empresas' => $empresas, 'cicles' => $cicles, 'comarques' => $comarques, 'sectors' => $sectors, "request" => $request]);
    }
  }

  function detail(Request $request, $id)
  {
    $empresa = Empresa::find($id);
    if (!isset($empresa->id)) {
      return redirect()->route('empresa_list');
    }
    $poblacio = Poblacio::find($empresa->poblacio_id);
    $contactes = Contacte::orderBy('name', 'asc')->where('empresa_id', '=', $empresa->id)->get();
    $estades = Estada::orderBy('student_name', 'asc')->where('empresa_id', '=', $empresa->id)->get();
    $users = User::all();
    $cursos = Curs::all();
    $cicles = Cicle::all();
    $comarques = Comarca::all();
    $sectors = Empresa::orderBy('sector', 'asc')->distinct("sector")->get("sector");

    return view('empresa.detail', ['empresa' => $empresa, "poblacio" => $poblacio, "contactes" => $contactes, "estades" => $estades,
    "users" => $users, "cursos" => $cursos, "cicles" => $cicles, "comarques" => $comarques, "sectors" => $sectors]);
  }

  function import(Request $request)
  {
    $file = fopen($_FILES["csv"]["tmp_name"], "r");
    $all_data = array();
    while (($data = fgetcsv($file, 0, ",")) !== FALSE ) {
      if ($data[3] != "cif") {
        $empresa = new Empresa;
        $empresa->cif = $data[3];
        $empresa->name = $data[4];
        $empresa->sector = $data[5];
        $empresa->poblacio_id = $data[6];
        $empresa->save();
      }
    }
    
    return redirect()->route('empresa_list');
  }

  function edit(Request $request, $id)
  {
    $empresa = Empresa::find($id);
    if ($request->isMethod('post')) {
      $empresa->cif = $request->cif;
      $empresa->name = $request->name;
      $empresa->sector = $request->sector;
      $empresa->poblacio_id = $request->poblacio_id;
      $empresa->save();

      return redirect()->route('empresa_detail', ['id' => $id])->with('status', 'Empresa ' . $empresa->name . ' modificada!');
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
