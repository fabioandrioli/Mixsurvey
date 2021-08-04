<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use SoftDeletes;

    protected $hidden = ['created_at','updated_at','description','deleted_at'];

    protected $fillable = ['title','description','image','survey_id','votes'];

    protected $dates = ['deleted_at'];

    public function optionSearch($search){
            return  Option::where('title','like','%'.$search.'%')
                            ->orWhere('id',$search)
                            ->orWhere('description','like','%'.$search.'%')
                            ->paginate(8);
    }

    public function users(){
        //return $this->belongsToMany(Survey::class, 'survey_user');
        return $this->belongsToMany(User::class);
    }

    public function optionSearchSite($search,$id=""){
            return Option::join('surveys','options.survey_id','surveys.id')
            ->select('options.*')
            ->where('options.title','like','%'.$search.'%')
            ->where('surveys.status',true)
            ->where('options.survey_id',$id)
            ->orWhere('options.description','like','%'.$search.'%' && 'surveys.status',true && 'options.survey_id',$id)
            ->get();
    }

    public static function mostVoted($limit = 3){
        return Option::join('surveys','options.survey_id','surveys.id')
        ->selectRaw('SUM(options.votes) as total')
        ->selectRaw('options.survey_id')
        ->where('surveys.status','!=',false)
        ->where('options.votes','>',0)
        ->groupBy('options.survey_id')
        ->orderBy('total','desc')
        ->limit($limit)
        ->get();
    }

    public function survey(){
        return $this->belongsTo(Survey::class);
    }
}
