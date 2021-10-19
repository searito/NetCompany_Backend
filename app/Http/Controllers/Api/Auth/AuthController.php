<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Api\Auth\RegistroRequest;

class AuthController extends Controller
{
    public function login(Request $request){
        $response = [
            'success'   =>  false,
            'data'      =>  null,
            'message'   =>  'No Autorizado',
        ];
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $succes['token'] = $user->createToken('NetCompany')->accessToken;
            $succes['name'] = $user->name.' '.$user->lastname;
            $succes['level'] = $user->level;

            $response = [
                'success'   =>  true,
                'data'      =>  $succes,
                'message'   =>  'Autorizado',
            ];
        }

        return response()->json(['response' => $response]);
    }

    public function registro(RegistroRequest $request){
        $user = new User();
        $user->name = htmlspecialchars(ucwords($request->nombres));
        $user->lastname = htmlspecialchars(ucwords($request->apellidos));
        $user->email = $request->correo;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        $user->estado = 1;
        $user->save() ? $status = 200 : $status = 500;

        return response()->json([
            'response'  =>  $status,
            'user'      =>  $user,
        ]);
    }
}
