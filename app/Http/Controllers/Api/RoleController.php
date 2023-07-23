<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    public function index(){
        $roles = Role::with('permissions')->get();
        $data['roles'] =  RoleResource::collection($roles);
        return $this->sendResponse($data, 'list of roles');
    }
}

