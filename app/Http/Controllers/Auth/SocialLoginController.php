<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function processLoginWithFacebook()
    {
        $faceBookUser = Socialite::driver('facebook')->user();
        if (!$faceBookUser) {
            return redirect('/login');
        }
        $SystemUser = User::where('facebook_id', '=', $faceBookUser->id)->first();
        if (!$SystemUser) {
            $SystemUser = User::create([
                'name' => $faceBookUser->name,
                'username' => $faceBookUser->name,
                'email' => $faceBookUser->email,
                'facebook_id' => $faceBookUser->id,
                'avatar' => $faceBookUser->avatar,
                'role_id' => 2
            ]);
        }
        Auth::loginUsingId($SystemUser->id);
        return redirect('/home');
    }
}
