<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);
       // If email does not exist
       if(!$this->validEmail($request->email)) {
        return response()->json([
            'message' => 'Email does not exist.'
        ], Response::HTTP_NOT_FOUND);
    } else {
        // If email exists
        $this->sendMail($request->email);
        return response()->json([
            'message' => 'Check your inbox, we have sent a link to reset email.'
        ], Response::HTTP_OK);            
    }
}
public function sendMail($email){
    $token = $this->generateToken($email);
    Mail::to($email)->send(new SendMail($token));
}
public function validEmail($email) {
    return !!User::where('email', $email)->first();
 }
public function generateToken($email){

     $isOtherToken = DB::table('password_resets')->where('email', $email)->first();
      if($isOtherToken) {
        return $isOtherToken->token;
      }
      $token = Str::random(80);;
      $this->storeToken($token, $email);
        return $token;
}
public function storeToken($token, $email){
    DB::table('password_resets')->insert([
        'email' => $email,
        'token' => $token,
        'created_at' => Carbon::now()            
    ]);
}

}
