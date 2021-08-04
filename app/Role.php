<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{

    use SoftDeletes;

    protected $fillable = ['title','description'];

    protected $dates = ['deleted_at'];

    public function roleSearch($search){
        return  Role::where('title','like','%'.$search.'%')
                        ->orWhere('id',$search)
                        ->orWhere('description','like','%'.$search.'%')
                        ->paginate(8);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
