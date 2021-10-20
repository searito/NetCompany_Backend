<?php

namespace App\Http\Controllers\Api\Usuarios;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsuariosController extends Controller
{
    public function read(){
        return response()->json(['response' => User::get()->toArray()]);
    }

    public function create(Request $request){}

    public function edit($id){}

    public function update(Request $request){}

    public function delete($id){}
}
