<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Category;
use App\Survey;
use App\Video;
use Illuminate\Support\Facades\Auth;
use Cookie;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{

    //$background = $data->map(function($value, $key){
    // return '#'.dechex(rand(0x000000, 0xffffff))
    // });
    protected $user, $role, $category, $survey, $video;
    public function __construct(User $user, Role $role, Category $category, Survey $survey, Video $video){
        $this->middleware('can:Administrador');
        $this->user = $user;
        $this->role = $role;
        $this->category = $category;
        $this->survey = $survey;
        $this->video = $video;
    }

    public function index(){
        return redirect()->route('statistics.index');
    }

    public function indexModuleUser(Request $request){
        if(!$request->searchIndexModuleUser)
            $users = $this->user->orderBy('id', 'DESC')->paginate(8);
        else
            $users = $this->user->userSearch($request->searchIndexModuleUser);
        return view('administrator.module_user.indexModuleUser',compact('users'));
    }

    public function userModuleFormCreate(){
        $roles = $this->role->all();
        return view('administrator.module_user.createEditModuleUser',compact('roles'));
    }

    public function createModuleUserWithRole(UserCreateRequest $request){
        if(Gate::allows('Webmaster')){
           $this->verifyCreateUserRole($request);
           return redirect()->route('index.module.user');
        }else{
            if(Role::find($request->role_id)->title != "Webmaster"){
                $this->verifyCreateUserRole($request);
                return redirect()->route('index.module.user');
            }
        }
        return redirect()->back()->withInput();
    }

    private function verifyCreateUserRole($request){
        $request['password'] = bcrypt('12345678');
        $this->user->create($request->all());

    }

    public function userModuleFormEdit($id){
        $user = $this->user->find($id);
        $roles = $this->role->all();
        return view('administrator.module_user.createEditModuleUser',compact('user','roles'));
    }




    public function updateModuleUserWithRole(Request $request, $id){
        if(Gate::allows('Webmaster')){
            $this->editVerifyRoleUser($request,$id);
            return redirect()->route('index.module.user');
        }else{
            if(Role::find($request->role_id)->title != "Webmaster" && $this->isWebmaster($id)){
                $this->editVerifyRoleUser($request,$id);
                return redirect()->route('index.module.user');
            }
        }
        return redirect()->back()->withInput();
    }

    private function isWebmaster($id){
        if($this->user->find($id)->role->title != "Webmaster")
            return true;
        return false;
    }

    private function editVerifyRoleUser($request,$id){
        $user = $this->user->find($id);
        $user->update($request->all());
    }

    public function userModuleFormDelete($id){
        $user = $this->user->find($id);
        return view('administrator.module_user.deleteModuleUser',compact('user'));
    }

    public function deleteModuleUserWithRole($id){
        $user = $this->user->find($id);
        if(Gate::allows('Webmaster')){
            $user->delete();
            return redirect()->route('index.module.user');
        }else{
            if($this->user->find($id)->role->title != "Webmaster"){
                $user->delete();
                return redirect()->route('index.module.user');
            }
        }
        return redirect()->back()->withInput();
    }


}
