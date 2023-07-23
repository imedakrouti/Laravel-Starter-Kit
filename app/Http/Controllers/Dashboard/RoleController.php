<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('permission:read_roles')->only(['index']);
        $this->middleware('permission:create_roles')->only(['create', 'store']);
        $this->middleware('permission:update_roles')->only(['edit', 'update']);
        $this->middleware('permission:delete_roles')->only(['delete', 'bulk_delete']);
    }
    public function index(Request $request)
    {
        $table_search=$request->table_search;
        //dd($table_search);
        // $roles = Role::whereNotIn('name', ['admin', 'super_admin'])
        // ->withCount(['users'])->get();   
       // $roles=Role::whereDoesntHave('users')->get();
    //    $roles=Role::whereHas('users',function($query){
    //     $query->whereName('super_admin');
    //    })->get();
      /*  $roles=Role::wherehas('users',fn($query)=>
       $query->whereName('super_admin'))->get(); */
    //    $roles=Role::when($table_search,function($query) use ($table_search){
    //     $query->whereName($table_search);
    //     )}->get();
        $roles=Role::WhenSearch(request()->search)
        ->latest()->paginate(4);
       
       return view ('dashboard.roles.index',compact('roles'));
         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions=Permission::all();
        //dd($permissions);
        return view('dashboard.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
           'description' =>'required|string|min:7',
            'permissions' => 'required|array|min:1',
        ]);
       // dd(gettype($request->permissions));

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description, 
        ]);
        $role->attachPermissions($request->permissions);
        return redirect()->route('dashboard.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->back();
    }
}
