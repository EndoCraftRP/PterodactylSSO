<?php

namespace Pterodactyl\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Pterodactyl\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

class SingleSignOnController extends AbstractLoginController
{

    public function Driver()
    {
        return Socialite::driver('authentik')->redirect();
    }

    public function DriverCallback()
    {
        $service = Socialite::driver('authentik')->user();

        if (User::where('email', '=', $service->getEmail())->exists()) {
            $getUser = User::where('email', $service->getEmail())->first();
            Auth::loginUsingId($getUser->id);
        }
        
        return redirect('/');
    }


}
