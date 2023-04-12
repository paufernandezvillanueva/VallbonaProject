<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Cicle;
use App\Models\Rol;

class UserController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function list()
  {
    $users = User::all();

    return view('user.list', ['users' => $users]);
  }

  function edit(Request $request, $id)
  {
    $user = User::find($id);
    if ($request->isMethod('post')) {
      // recollim els camps del formulari en un objecte user

      //$user = new User;
      $user->firstname = $request->firstname;
      $user->lastname = $request->lastname;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->cicle_id = $request->cicle_id;
      $user->rol_id = $request->rol_id;
      $user->save();

      return redirect()->route('user_list');
    }
    // si no venim de fer submit al formulari, hem de mostrar el formulari

    $cicles = Cicle::all();
    $rols = Rol::all();

    return view('user.edit', ['cicles' => $cicles, 'rols' => $rols, 'user' => $user]);
  }

  function new(Request $request)
  {
    if ($request->isMethod('post')) {
      // recollim els camps del formulari en un objecte user

      $user = new User;
      $user->firstname = $request->firstname;
      $user->lastname = $request->lastname;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);
      $user->cicle_id = $request->cicle_id;
      $user->rol_id = $request->rol_id;
      $user->save();

      return redirect()->route('user_list');
    }
    // si no venim de fer submit al formulari, hem de mostrar el formulari

    $cicles = Cicle::all();
    $rols = Rol::all();

    return view('user.new', ['cicles' => $cicles, 'rols' => $rols]);
  }

  function delete($id)
  {
    $user = User::find($id);
    $user->delete();

    return redirect()->route('user_list');
  }
}
