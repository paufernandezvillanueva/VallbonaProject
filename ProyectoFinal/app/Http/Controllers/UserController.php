<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Models\User;
use App\Models\Cicle;
use App\Models\Rol;

class UserController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  function list(Request $request)
  {
    if (Auth::user()->rol_id == 5076) {
      $users = User::leftjoin("cicles", "cicles.id", "=", "users.cicle_id");

      if (isset($request->name)) {
        if ($request->name != "") {
          $users = $users->where('users.name', 'like', "%" . $request->name . "%");
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

      $users = $users->distinct("users.*")->orderBy('users.name', 'asc')->get("users.*");

      $cicles = Cicle::all();
      $rols = Rol::all();

      return view('user.list', ['users' => $users, 'cicles' => $cicles, 'rols' => $rols, 'request' => $request]);
    } else {
      return redirect('');
    }
  }

  function import(Request $request)
  {
      $file = fopen($_FILES["csv"]["tmp_name"], "r");
      $all_data = array();
      while (($data = fgetcsv($file, 0, ",")) !== FALSE ) {
        if ($data[3] != "name") {
          $user = new User;
          $user->name = $data[3];
          $user->email = $data[4];

          if ($data[5] != 'NULL') {
            $user->email_verified_at = $data[5];
          }

          $user->password = $data[6];

          if ($data[7] != 'NULL') {
            $user->two_factor_secret = $data[7];
          }

          if ($data[8] != 'NULL') {
            $user->two_factor_recovery_codes = $data[8];
          }

          if ($data[9] != 'NULL') {
            $user->two_factor_confirmed_at = $data[9];
          }

          if ($data[10] != 'NULL') {
            $user->remember_token = $data[10];
          }

          if ($data[11] != 'NULL') {
            $user->current_team_id = $data[11];
          }

          if ($data[12] != 'NULL') {
            $user->profile_photo_path = $data[12];
          }

          if ($data[13] != 'NULL') {
            $user->darkmode = $data[13];
          }

          if ($data[14] != 'NULL') {
            $user->cicle_id = $data[14];
          }

          $user->rol_id = $data[15];

          if ($data[16] != 'NULL') {
            $user->google_id = $data[16];
          } else {
            $user->google_id = null;
          }
          
          $user->save();
        }
      }
      
      return redirect()->route('user_list');
  }

  function profile()
  {
    $user = auth()->user();
    $cicles = Cicle::all();
    $rols = Rol::all();
    return view('user.profile', compact('user'), ['cicles' => $cicles, 'rols' => $rols]);
  }

  function update(Request $request)
  {
    $user = auth()->user();
    $user->name = $request->name;
    $user->email = $request->email;
    if (!empty($request->password)) {
      if ($request->password != $request->password_confirmation) {
        return redirect()->back()->withInput()->withErrors(['password' => __('Las contraseñas no coinciden.')]);
      }
      $user->password = Hash::make($request->password);
    }
    $user->save();

    return redirect()->route('user_profile')->with('success', 'Datos actualizados correctamente');
  }

  function edit(Request $request, $id)
  {
    if (Auth::user()->rol_id == 5076) {
      $user = User::find($id);
      if ($request->isMethod('post')) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->cicle_id = $request->cicle_id;
        $user->rol_id = $request->rol_id;
        $user->save();

        return redirect()->route('user_detail', ['id' => $id]);
      }
    } else {
      return redirect('');
    }
  }

  function detail(Request $request, $id)
  {
    $user = User::find($id);
    $cicles = Cicle::all();
    $rols = Rol::all();

    return view('user.detail', ['user' => $user, 'cicles' => $cicles, 'rols' => $rols]);
  }

  function new(Request $request)
  {
    if (Auth::user()->rol_id == 5076) {
      if ($request->isMethod('post')) {
        $user = new User;
        $user->name = $request->name;
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
