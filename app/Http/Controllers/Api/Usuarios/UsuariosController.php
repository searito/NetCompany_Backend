<?php

namespace App\Http\Controllers\Api\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\Users\UserRequest;
use App\Models\User;

class UsuariosController extends Controller
{
    public function read(){
        return response()->json(['response' => User::get()->toArray()]);
    }

    public function create(UserRequest $request){
        $user = new User();
        $user->name = htmlspecialchars(ucwords($request->nombres));
        $user->lastname = htmlspecialchars(ucwords($request->apellidos));
        $user->email = $request->correo;
        $user->password = bcrypt($request->password);
        $user->level = $request->nivel;
        $user->estado = $request->estado;
        $user->save() ? $status = 200 : $status = 500;

        return response()->json([
            'response'  =>  $status,
            'user'      =>  $user,
        ]);
    }

    public function edit($id){
        return response()->json(['response' => User::find($id)]);
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $user->name = htmlspecialchars(ucwords($request->nombres));
        $user->lastname = htmlspecialchars(ucwords($request->apellidos));
        $user->email = $request->correo;
        if ($request->password !== null) {
            $user->password = bcrypt($request->password);
        }
        $user->level = $request->nivel;
        $user->estado = $request->estado;
        $user->save() ? $status = 200 : $status = 500;

        return response()->json([
            'response'  =>  $status,
            'user'      =>  $user,
        ]);
    }

    public function delete($id){
        return response()->json(['deleted' => User::destroy($id)]);
    }
}
