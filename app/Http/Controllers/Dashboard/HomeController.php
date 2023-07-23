<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
       public function __construct()
    {
       // $this->middleware(['auth','verified']);
    }
    public function index(){
        $user = User::find(1);
       // dd($user->roles);
        // $roles = array();
        // foreach ($user->roles as $role) {
        //     # code...
        //     array_push($roles, $role->display_name);
        // }
    //    return response()->json(
    //     ['role'=>$user->roles->first()->display_name,
    //     'permissions'=>$user->permission
    //     ]
    //    );
       // dd($user->allPermissions());

        return view("dashboard.home");
    }
}
