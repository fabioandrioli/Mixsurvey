<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','description','slug','user_id', 'spotlight','views'];

    protected $dates = ['deleted_at'];

    public function categorySearch($search){
        return  Category::where('title','like','%'.$search.'%')
                        ->orWhere('id',$search)
                        ->orWhere('description','like','%'.$search.'%')
                        ->paginate(8);
    }

    public function surveis(){
        return $this->hasMany(Survey::class);
    }

    public function mostViews($limit = 3){
        return Category::orderBy('views','DESC')->limit(3)->get();
    }
}
