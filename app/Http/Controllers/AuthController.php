<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function createUser(CreateUserRequest $request)
    {
        //crear usuario, agregar campos adicionales, y hashear contraseña
        User::create($request->except('password','active','role_id') + ['active' => true, 'role_id' => 2, 'password' => Hash::make($request->password)]);

        return response()->json([
            'status' => true,
            'message' => 'usuario creado',
        ], 201);
    }

    public function loginUser(LoginRequest $request)
    {
        //buscar usuario
        $user = User::firstWhere('user', $request->user);

        //usuario no encontrado
        if (!$user)
            return response()->json(['status' => false, 'message' => 'invalid user'], 401);

        //intentar autenticar
        if (!Auth::attempt($request->only(['user', 'password']))) {
            return response()->json(['status' => false, 'message' => 'invalid password'], 401);
        }

        //auntenticacion exitosa
        return response()->json(['status' => true, 'message' => 'welcome', 'token' => $user->createToken('API TOKEN')->plainTextToken]);

        //cuando el usuario se logee se podra accer a toda la informacion de su modelo  
        //Auth::user();
    }
}
