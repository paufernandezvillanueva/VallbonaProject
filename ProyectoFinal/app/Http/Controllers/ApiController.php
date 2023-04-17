<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;

use App\Models\Comarca;
use App\Models\Poblacio;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function getComarques() {
        $comarcas = Comarca::all();
        
        foreach($comarcas as $comarca) {
            $elementos_json[] = "\"" . $comarca->id . "\": \"" . $comarca->name . "\"";
        }

        return "{".implode(",", $elementos_json)."}";
    }

    function getPoblacio(Request $request, $id) {
        $poblacions = Poblacio::where("comarca_id", "=", $id)->get();
        
        foreach($poblacions as $poblacio) {
            $elementos_json[] = "\"" . $poblacio->id . "\": \"" . $poblacio->name . "\"";
        }

        return "{".implode(",", $elementos_json)."}";
    }

}
