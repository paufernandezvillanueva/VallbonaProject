<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use App\Models\Estada;
use App\Models\Cicle;
use App\Models\Empresa;
use App\Models\Curs;
use App\Models\User;

class EstadaController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function list(Request $request)
    {
        $estadas = Estada::join("empresas", "empresas.id", '=', 'estadas.empresa_id')->
        join("users", "users.id", '=', 'estadas.registered_by');
        
        if (isset($request->name)) {
            if ($request->name != "") {
              $estadas = $estadas->where('estadas.student_name', 'like', "%" . $request->name . "%");
            }
        }

        if (isset($request->curs)) {
            if ($request->curs != "") {
              $estadas = $estadas->where('estadas.curs_id', '=', $request->curs);
            }
        }
        
        if (isset($request->cicle)) {
            if ($request->cicle != "") {
              $estadas = $estadas->where('estadas.cicle_id', '=', $request->cicle);
            }
        }
        if (isset($request->registeredBy)) {
            if ($request->registeredBy != "") {
              $estadas = $estadas->where('users.firstname', 'like', "%" . $request->registeredBy . "%")->
              orWhere('users.lastname', 'like', "%" . $request->registeredBy . "%");
            }
        }

        if (isset($request->empresa)) {
            if ($request->empresa != "") {
              $estadas = $estadas->where('empresas.name', 'like', "%" . $request->empresa . "%");
            }
        }
        
        if (isset($request->tipus)) {
            if ($request->tipus != "") {
              $estadas = $estadas->where('estadas.dual', '=', $request->tipus);
            }
        }

        if (isset($request->minValoracio)) {
          if (!isset($request->maxValoracio) || $request->maxValoracio >= $request->minValoracio) {
            $estadas = $estadas->groupBy("empresas.id")->where('estadas.evaluation', '>=', $request->minValoracio);
          }
        }
    
        if (isset($request->maxValoracio)) {
            $estadas = $estadas->groupBy("empresas.id")->where('estadas.evaluation', '<=', $request->maxValoracio);
        }
        
        $estadas = $estadas->distinct("estadas.*")->get("estadas.*");

        $cicles = Cicle::all();
        $empresas = Empresa::all();
        $users = User::all();
        $cursos = Curs::all();
        return view('estada.list', ['estadas' => $estadas, 'cicles' => $cicles, 'empresas' => $empresas, 'users' => $users, 'cursos' => $cursos, 'request' => $request]);
    }

    function detail(Request $request, $id)
    {
        $estada = Estada::find($id);
        $cicle = Cicle::find($estada->cicle_id);
        $empresa = Empresa::find($estada->empresa_id);
        $curs = Curs::find($estada->curs_id);

        return view('estada.detail', ['estada' => $estada, 'cicle' => $cicle, 'empresa' => $empresa, 'curs' => $curs]);
    }

    function new(Request $request)
    {
        if ($request->isMethod('post')) {
            $estada = new Estada;
            $estada->student_name = $request->student_name;
            $estada->cicle_id = $request->cicle_id;
            $estada->empresa_id = $request->empresa_id;
            $estada->evaluation = $request->evaluation;
            $estada->comment = $request->comment;
            $estada->dual = $request->dual;
            $estada->registered_by = $request->registered_by;
            $estada->curs_id = $request->curs_id;
            $estada->save();

            return redirect()->route('estada_list');
        }
        $cicles = Cicle::all();
        $empresas = Empresa::all();
        $usuaris = User::all();
        $cursos = Curs::all();
        return view('estada.new', ['cicles' => $cicles, 'empresas' => $empresas, 'usuaris' => $usuaris, 'cursos' => $cursos]);
    }

    function edit(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $estada = Estada::find($id);
            $estada->student_name = $request->student_name;
            $estada->cicle_id = $request->cicle_id;
            $estada->empresa_id = $request->empresa_id;
            $estada->evaluation = $request->evaluation;
            $estada->comment = $request->comment;
            $estada->dual = $request->dual;
            $estada->registered_by = $request->registered_by;
            $estada->curs_id = $request->curs_id;
            $estada->save();

            return redirect()->route('estada_list');
        }
        $estada = Estada::find($id);

        return view('estada.edit', ['estada' => $estada]);
    }

    function delete($id)
    {
        $estada = Estada::find($id);
        $estada->delete();

        return redirect()->route('estada_list');
    }
}
