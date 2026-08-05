<?php

use Illuminate\Support\Facades\Route;
use Pterodactyl\Http\Controllers\Auth;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Endpoint: /auth
|
*/

// Route /login
Route::get('/login', function () {
    return redirect('/auth/login/sso'); // Redirect to /auth/login/sso
})->name('auth.login');

// Route /password
Route::get('/password', function () {
    return redirect('/auth/login/sso'); // Redirect to /auth/login/sso
})->name('auth.forgot-password');

// Route /password/reset/{token}

// Apply a throttle to authentication action endpoints, in addition to the
// recaptcha endpoints to slow down manual attack spammers even more. 🤷‍
//
// @see \Pterodactyl\Providers\RouteServiceProvider
/*Route::middleware(['throttle:authentication'])->group(function () {
    // Login endpoints.
    Route::post('/login', [Auth\LoginController::class, 'login'])->middleware('recaptcha');
    Route::post('/login/checkpoint', Auth\LoginCheckpointController::class)->name('auth.login-checkpoint');

    // Forgot password route. A post to this endpoint will trigger an
    // email to be sent containing a reset token.
    Route::post('/password', [Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('auth.post.forgot-password')
        ->middleware('recaptcha');
});
 */
// Password reset routes. This endpoint is hit after going through
// the forgot password routes to acquire a token (or after an account
// is created).

// Remove the guest middleware and apply the authenticated middleware to this endpoint,
// so it cannot be used unless you're already logged in.
Route::post('/logout', [Auth\LoginController::class, 'logout'])
    ->withoutMiddleware('guest')
    ->middleware('auth')
    ->name('auth.logout');

// Catch any other combinations of routes and pass them off to the React component.
/*Route::fallback(function () {
    return redirect('/auth/login/sso');
});
*/
