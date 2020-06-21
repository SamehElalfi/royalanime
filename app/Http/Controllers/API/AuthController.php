<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        
        try {
            $request->request->add([
            'grant_type' => 'password',
            'username' => $request->email,
            'client_id' => config('services.passport.client_id'),
            'client_secret' => config('services.passport.client_secret'),
            'scope' => '*']);
    
            $newRequest = Request::create('/oauth/token', 'post');
    
            return Route::dispatch($newRequest);
        } catch (Exception $e) {
            return response()->json('Something went wrong on the server.', $e->getCode());
        }
    }
}
