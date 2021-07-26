<?php

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Route;

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

Route::post('token/create', function () {
    $credentials = request()->validate([
        'email' => 'required|email|exists:users',
        'password' => 'required|string',
    ], request()->all());

    $user = User::where('email', $credentials['email'])->first();

    if (!auth()->validate($credentials)) {
        throw new AuthenticationException();
    }

    $token = $user->createToken('webhook-'.$user->id);

    return [ 'token' => $token->plainTextToken ];
});
