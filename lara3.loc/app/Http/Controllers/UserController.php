<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;


class UserController extends Controller
{
    public function create(){
        return view('user.create');// будет отвечать за показ формы регистрации
    }
    public function login(){
        return view('user.login');// будет отвечать за показ формы входа
    }

 //2/ Обработка регистрации + внесение в бд
    public function store(Request $request){
        $request->validate([
            'name'=>['required', 'max:255'],
            'email'=>['required', 'max:255', 'email','unique:users'],
            'password'=>['required','confirmed']
        ]);
        $user = User::create($request->all());
        //event- для начала аутентификации
        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('verification.notice');
        //dd($request->all());// Функция dd (Dump and Die) выводит данные на экран и вызывает die, блокируя дальнейшее выполнение кода
        // Функция dump также выводит данные на экран, но не блокирет дальнейшее выполнение кода
    }
       

    public function logout(Request $request): RedirectResponse
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
}

    public function dashboard() {
        return view('user.dashboard');// будет отвечать за показ дашборда
    }

    public function loginAuth(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
//$request->boolean('remember')) - для подбора значения чекбокса
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
    
    public function passwordResetStore(Request $request){
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

   public function passwordResetUpdate(Request $request){
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:1|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
   }

}
