<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests\EditProfileRequest;
use App\Http\Requests\EditProfilePasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{


    protected $user;
    protected $role;

    public function __construct(User $user, Role $role){
        $this->user = $user;
        $this->role = $role;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('site.profile.showProfile');
    }







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function showSurveyProfile(){
        $surveis = Auth::user()->surveys()->paginate(5);
        return view('site.profile.showSurveyProfile',compact('surveis'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(){
        return view('site.profile.editProfile');
    }

    public function editPassword(){
        return view('site.profile.editPassword');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProfileRequest $request){
        $dataUser['name'] = $request->input('name');
        $dataUser['email'] = $request->input('email');
        $user = Auth::user();
        if($user->update($dataUser))
            return redirect()->route('guest.index');
        else
            return redirect()->back()->withInput();
    }

    public function updatePassword(EditProfilePasswordRequest $request){
        if (Hash::check($request->oldPassword, Auth::user()->password)) {
            $dataUser['password'] = $request->password;
            $dataUser['password'] = bcrypt($dataUser['password']);
            $user = Auth::user();
            $user->update($dataUser);
            return redirect()->route('guest.index');
        }

        return redirect()->back()->withErrors(['Senha atual nao corresponde'])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
