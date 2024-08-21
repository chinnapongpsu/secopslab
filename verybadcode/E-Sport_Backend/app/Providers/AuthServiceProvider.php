<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

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
            if ($request->input('api_token')) {
                $token = $request->input('api_token');
            
            
                try { 
                    $credentials = JWT :: decode($token, env('APP_KEY'),['H5256']);
                    return new GenericUser (['id'=> $credentials->sub]);


                }catch (Exception $e){
                    return null;
                }
                //return User::where('api_token', $request->input('api_token'))->first();
            }
        });
    }
}
