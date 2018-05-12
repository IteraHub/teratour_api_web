<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Hash;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function ($request) {
           
        if(empty($header))
            $result = $request->header('authorization');
            if ($request->header('authorization')) {
                $token = explode(' ',$result)[1];
                $vals = explode(':',base64_decode($token));
                $details = (object) ['username'=>$vals[0],'password'=>$vals[1]];

                $user =  User::where('username',$details->username)
                                ->orWhere('email',$details->username)
                                ->first();

                if(Hash::check($details->password,$user->password)){
                    return $user;
                }
            }
        });
    }
}
