<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Cicle;
use App\Models\Rol;

class UserController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function list(Request $request)
  {
    if (Auth::user()->rol_id == 5076) {
      $users = User::join("cicles", "cicles.id", "=", "users.cicle_id");

      if (isset($request->name)) {
        if ($request->name != "") {
          $users = $users->where('users.firstname', 'like', "%" . $request->name . "%")->orWhere('users.lastname', 'like', "%" . $request->name . "%");
        }
      }
      
      if (isset($request->cicle)) {
        if ($request->cicle != "") {
          $users = $users->where('users.cicle_id', '=', $request->cicle);
        }
      }
      
      if (isset($request->rol)) {
        if ($request->rol != "") {
          $users = $users->where('users.rol_id', '=', $request->rol);
        }
      }

      $users = $users->distinct("users.*")->get("users.*");

      $cicles = Cicle::all();
      $rols = Rol::all();

      return view('user.list', ['users' => $users, 'cicles' => $cicles, 'rols' => $rols, 'request' => $request]);
    } else {
      return redirect('');
    }
  }

  function edit(Request $request, $id)
  {
    if (Auth::user()->rol_id == 5076) {
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
    } else {
      return redirect('');
    }
  }

  function new(Request $request)
  {
    if (Auth::user()->rol_id == 5076) {
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
    } else {
      return redirect('');
    }
  }

  function delete($id)
  {
    if (Auth::user()->rol_id == 5076) {
      $user = User::find($id);
      $user->delete();

      return redirect()->route('user_list');
    } else {
      return redirect('');
    }
  }
}
