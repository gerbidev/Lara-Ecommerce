<?php

namespace App\Http\Controllers;

use App\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
//    Retorna todos los usuarios con sus ordenes
    public function index()
    {
        return response()->json(User::with(['orders'])->get());
    }

    // registra un usuario y genera un token de acceso para el usuario
    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        if (Auth::attempt($request->only(['email','password']))){
            $status = 200;
            $response = [
              'user' => Auth::user(),
              'token' => Auth::user()->createToken('Lara-Ecommerce')->accessToken,
            ];
        }

        return response()->json($response, $status);
    }

    // Crea una cuenta de usuario. autentifica y genera un toke de acceso
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails())
        {
            return response()->json(['error'=> $validator->errors()],401);
        }

        $data = $request->only(['name','email','password']);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);
        $user->is_admin = 0;

        return response()->json([
           'user'=> $user,
           'token' => $user->createToken('Lara-Ecommerce')->accesToken,
        ]);
    }

    // Obtiene los detalles de un usuario y los retorna
    public function show(User $user)
    {
        return response()->json($user);
    }

    //Obtiene todas las ordenes de un usuario y los retorna
    public function showOrders(User $user)
    {
        return response()->json($user->orders()->with(['product'])->get());
    }

}
