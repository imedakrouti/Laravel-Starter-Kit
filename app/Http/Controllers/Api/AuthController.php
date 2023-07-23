<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Events\Registered;

class AuthController extends BaseController
{
    public function createUser( RegisterRequest $request){

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'password' => Hash::make($request->password)
        ]);
        //  event(new Registered($user));
         $user->attachRole('admin');
         $user->sendApiEmailVerification();

        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['user'] = new UserResource($user);
        return $this->sendResponse($success, 'User login successfully.');

    }
    public function loginUser(Request $request)
    {
        # code...

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
          //  $success['role'] = $user->roles->first()->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Verify your login and password.', ['error'=>'Unauthorised']);
        }
    }

    }

