<?php

namespace App\Http\Controllers\Auth;

use App\DatosUsuario;
use App\Direccion;
use App\Pago;
use App\Telefono;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/usuario';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user) {
        //Enviar email
        $user->enviarCorreoConfirmacion();

        //Cerrar sesión para bloquear hasta que confirme su cuenta
        Auth::logout();

        session(['registrado' => 'Te hemos enviado un correo de confirmación']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        $user = new User();

        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->save();

        DatosUsuario::create([
            'id_usuario' => $user->id,
            'id_tipo_cuenta' => 2,
            'confirmacion_cuenta' => false,
            'id_estatus' => 1
        ]);

        Direccion::create([
            'id_usuario' => $user->id
        ]);

        Pago::create([
            'id_usuario' => $user->id,
            'id_estatus' => 1
        ]);

        Telefono::create([
            'id_usuario' => $user->id
        ]);

        return $user;
    }
}
