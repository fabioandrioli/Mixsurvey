<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\True_;

class Survey extends Model
{
    use SoftDeletes;

    protected $fillable = ['title','description','status','slug','start_date','spotlight','inSession','capa','finish_date','image','user_id','category_id','views'];

    protected $dates = ['deleted_at'];

    public function surveySearch($request){
        $count = 0;
        if(!empty($request->status))
            $count = count($request->status);
        if($count > 1 || empty($request->status) && !isset($request->destaque)){
            return  Survey::where('title','like','%'.$request->searchIndexModuleSurvey.'%')
                            ->orWhere('id',$request->searchIndexModuleSurvey)
                            ->orWhere('description','like','%'.$request->searchIndexModuleSurvey.'%')
                            ->orWhere('spotlight',$request->destaque)
                            ->orderBy('id', 'DESC')
                            ->paginate(5);
        }else{
            if(isset($request->destaque)){
                return  Survey::where('spotlight',$request->destaque)
                                ->orderBy('id', 'DESC')
                                ->paginate(5);
            }else
                return  Survey::where('status','=',$request->status[0])
                                ->where('title','like','%'.$request->searchIndexModuleSurvey.'%')
                                ->orWhere('id',$request->searchIndexModuleSurvey && 'status',$request->status[0])
                                ->orWhere('description','like','%'.$request->searchIndexModuleSurvey.'%' && 'status',$request->status[0])
                                ->orderBy('id', 'DESC')
                                ->paginate(5);
        }
    }

    public function surveySearchSite($request){
            return  Survey::where('title','like','%'.$request.'%')
                            ->where('status',true)
                            ->orderBy('id', 'DESC')
                            ->paginate(5);
    }

    public function destaques(){
        return  Survey::where('status',true)
                            ->where('spotlight',true)
                            ->orWhere('capa',true && 'status',true)
                            ->orderBy('id','DESC')
                            ->limit(3)->get();
    }

    public function mostViews($limit = 3){
        return Survey::orderBy('views','DESC')->limit(3)->get();
    }

    public function options(){
        return $this->hasMany(Option::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        //return $this->belongsToMany(Survey::class, 'survey_user');
        return $this->belongsToMany(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getOption(){
        return Survey::options()->selectRaw('options.id, options.title, options.image, options.description, options.survey_id')->get();
    }
}
