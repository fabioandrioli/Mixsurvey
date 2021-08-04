<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Role;

class User extends Authenticatable
{
    use Notifiable;

    public function survey(){
        return $this->hasMany(Survey::class);
    }

    public function surveys(){
        //return $this->belongsToMany(Survey::class, 'survey_user');
        return $this->belongsToMany(Survey::class);
    }

    public function options(){
        //return $this->belongsToMany(Survey::class, 'survey_user');
        return $this->belongsToMany(Option::class);
    }

    public function userSearch($search){
        return  User::where('name','like','%'.$search.'%')
                        ->orWhere('id',$search)
                        ->orWhere('email','like','%'.$search.'%')
                        ->paginate(8);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function hasRole($role){
        if(is_string($role)){
           return $this->role()->first()->title == $role;
        }
           return $this->hasRole($role->title);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image', 'role_id'
    ];


    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
