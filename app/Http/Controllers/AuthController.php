<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    /**

     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->createNewToken($token);
    }




    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|between:2,100',
            'prenom' => 'required|string|between:2,100',
            'CIN' => 'string',
            'email' => 'required|string|email|max:100|unique:users',
            'CNE' => 'string|max:10',
            'date_n' => 'date',
            'id_semestre' => 'integer',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        
        $user->attachRole($request->role);
        
        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user,
        ], 201);
    }
    
    public function checkToken()
    {
        return response()->json(['success' => true], 200);
    }

    public function logout()
    {
        $logout = auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    protected function createNewToken($token)
    {
        if (auth()->user()->hasRole('Admin')) {
            $role = 'Admin';
        } elseif (auth()->user()->hasRole('Teacher')) {
            $role = 'Teacher';
        } else {
            $role = 'Student';
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user(),
            'role' => $role,
        ]);
    }
}
