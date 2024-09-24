<?php



use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('welcome');
})->name('home'); 

Route::middleware('auth')->group(function(){
    Route::get('logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

    //маршрут отправки ссылки на почту
    Route::get('/verify-email', function () {
        return view('user.verify-email');
    })->name('verification.notice');

    // маршрут перехода пользователя по ссылке
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect()->route('dashboard');
    })->middleware('signed')->name('verification.verify');

    //повторная отправка письма на почту 
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware('throttle:3,1')->name('verification.send');

});
//48 только для гостя
Route::middleware('guest')->group(function(){
    Route::get('register', [App\Http\Controllers\UserController::class, 'create'])->name('register');
    Route::get('login', [App\Http\Controllers\UserController::class, 'login'])->name('login');

    Route::post('register', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');    
    Route::post('login', [App\Http\Controllers\UserController::class, 'loginAuth'])->name('login.auth');
   
    Route::get('/forgot-password', function () {
        return view('user.forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', [App\Http\Controllers\UserController::class, 'passwordResetStore'])->name('password.email');

    Route::get('/reset-password/{token}', function (string $token) {
        return view('user.reset-password', ['token' => $token]);
    })->name('password.reset');
//обновить базу данных
    Route::post('reset-password', [App\Http\Controllers\UserController::class, 'passwordResetUpdate'])->name('password.update');

});

Route::middleware(['auth', 'verified'])->group(function(){   
    Route::get('dashboard', [App\Http\Controllers\UserController::class, 'dashboard'])->name('dashboard');
});