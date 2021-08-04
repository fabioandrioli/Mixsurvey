<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\RoleCreateRequest;

class RoleController extends Controller
{


    protected $role;

    public function __construct(Role $role){
        $this->middleware('can:Webmaster');
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(!$request->searchIndexModuleRole)
            $roles = $this->role->orderBy('id', 'DESC')->paginate(8);
        else{
            $roles = $this->role->roleSearch($request->searchIndexModuleRole);
        }
        return view('administrator.module_role.indexModuleRole',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $roles = $this->role->all();
        return view('administrator.module_role.createEditModuleRole',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request){
        if(isset($request->title) && isset($request->description)){
            $this->role->create($request->all());
        }else
            return redirect()->back()->with('error', 'Something went wrong.');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $role = $this->role->find($id);
        $users = $role->users()->paginate(8);
        return view('administrator.module_user.indexModuleUser',compact('users','role'));
    }

    public function searchRoleUser($id, Request $request){
        $role = $this->role->find($id);
        $users = User::where([['role_id','=',$role->id],['name','like','%'.$request->searchIndexModuleUser.'%']])->paginate(8);
        return view('administrator.module_user.indexModuleUser',compact('users','role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $role = $this->role->find($id);
        return view('administrator.module_role.createEditModuleRole',compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(RoleCreateRequest $request, $id){
        if(isset($request->title) && isset($request->description)){
            $role = $this->role->find($id);
            $role->update($request->all());
        }else
            return redirect()->back()->with('error', 'Something went wrong.');
        return redirect()->route('roles.index');
    }


    public function roleModuleFormDelete($id){
        $role = $this->role->find($id);
        return view('administrator.module_role.deleteModuleRole',compact('role'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $role = $this->role->find($id);
        $role->delete();
        return redirect()->route('roles.index');
    }
}
