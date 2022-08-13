<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserLoginLogout;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected function authenticated()
    {
        if (Cache::has('active_users'))
        {
             if (!Cache::has('user_'.Auth::user()->id))
            {
                Cache::rememberForever('user_'.Auth::user()->id,function() { return User::where("id",Auth::user()->id)->first();});
                Cache::increment('active_users');
            }
        }
        else {
            Cache::put('active_users', 1);
        }
        event(new UserLoginLogout());


        if(Auth::user()->role_as == '1') //1 = Admin  Login
        {
            return redirect('dashboard')->with('status','Welcome to your dashboard');
        }
        elseif(Auth::user()->role_as == '0') // Normal or Default User Login
        {
            return redirect('/')->with('status','Logged in successfully');
        }
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */

    public function maxAttempts()
    {
        return property_exists($this, 'maxAttempts') ? $this->maxAttempts : 4;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return property_exists($this, 'decayMinutes') ? $this->decayMinutes :  4;
    }
}

