<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Persona;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function __construct() {
    $this->middleware('auth')->only('usuario/profile', 'update_profile');
  }
  //envía los datos del usuario logueado a la vista.
  public function profile() {
    $user = Auth::user();
    return view('usuario/profile', ['user' => $user]);
  }
  //valida que sea una imagen lo que enviamos, la sube a la carpeta public/uploads/avatars  y después guarda el nombre en la base de datos y volvemos al perfil.
  public function update_profile(Request $request) {
    $this->validate($request, [
      'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
    ]);

    $filename = Auth::id().'_'.time().'.'.$request->avatar->getClientOriginalExtension();
    $request->avatar->move(public_path('uploads/avatars'), $filename);

    $user = Auth::user();
    $user->avatar = $filename;
    $user->save();

    return redirect()->route('user.profile');
  }
  public function index (){
    /*$personas=Persona::orderBy('id_persona','ASC')
    ->paginate(2);
    $users=User::orderBy('id_persona_fk','ASC')
    ->paginate(2);
    */
    $personas=DB::table('personas')
    ->join('users','personas.id_persona','=','users.id_persona_fk')
    ->orderBy('id_persona_fk','ASC')
    ->paginate(2);
    return view('usuario.index',compact('personas'));
    }
}
