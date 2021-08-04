<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Newletter extends Model
{
    protected $fillable = ['email'];

    public function letterSearch($search){
        return  Newletter::where('email','like','%'.$search.'%')
                        ->orWhere('id',$search)
                        ->paginate(8);
    }
}
