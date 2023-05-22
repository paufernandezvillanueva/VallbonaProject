<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function index()

    {

        return view('lang');

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function change(Request $request)

    {

        App::setLocale($request->lang);

        session()->put('locale', $request->lang);



        return redirect()->back();

    }
}
