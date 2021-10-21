<?php
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use App\Http\Controllers\Api\Usuarios\UsuariosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
    'prefix'    =>  'auth'
], function (){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'registro']);
});

Route::group([
    'prefix'        => 'dashboard',
    'middleware'    =>  'auth:api'
], function (){
    Route::get('/', [DashboardController::class, 'index']);
});

Route::group([
    'prefix'        =>  'usuarios',
    'middleware'    =>  'auth:api'
], function (){
    Route::post('/', [UsuariosController::class, 'create']);
    Route::put('/', [UsuariosController::class, 'update']);
    Route::get('/read', [UsuariosController::class, 'read']);
    Route::get('/edit/{id}', [UsuariosController::class, 'edit']);
    Route::delete('/delete/{id}', [UsuariosController::class, 'delete']);
});
