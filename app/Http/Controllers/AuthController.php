<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Crear un nuevo usuario en el sistema.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'user',
        ]);
    
        $token = JWTAuth::fromUser($user);
    
        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }
    
    /**
     * Iniciar sesión y obtener un token JWT.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ]);
    
        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'No autorizado'], 401);
        }
    
        return response()->json([
            'token' => $token,
            'user' => Auth::user()
        ]);
    }
    
    /**
     * Cerrar sesión (invalidar el token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Sesión cerrada correctamente']);
    }
    
    /**
     * Refrescar un token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return response()->json([
            'token' => JWTAuth::refresh(),
            'user' => Auth::user()
        ]);
    }
}