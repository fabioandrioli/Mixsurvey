<?php

namespace App\Http\Controllers;

use App\Survey;
use Illuminate\Http\Request;
use App\Category;
use Coockie;
use App\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SurveyCreateRequest;


class SurveyController extends Controller
{
    protected $survey;
    protected $category;

    public function __construct(Survey $survey, Category $category){
        $this->middleware('can:Administrador');
        $this->survey = $survey;
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(!$request->searchIndexModuleSurvey && !$request->status && !$request->destaque)
            $surveis = $this->survey->orderBy('id', 'DESC')->paginate(8);
        else{
            $surveis = $this->survey->surveySearch($request);
        }
        return view('administrator.module_survey.indexModuleSurvey',compact('surveis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories = $this->category->all();
        return view('administrator.module_survey.createEditModuleSurvey',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurveyCreateRequest $request){
        $dataSurvey = $request->all();

        if(!isset($dataSurvey['status'])){
            $dataSurvey['status'] = 0;
        }else if( $dataSurvey['status'] != 1 &&  $dataSurvey['status'] != 0)
            $dataSurvey['status'] = 0;

        if(!isset($dataSurvey['spotlight'])){
                $dataSurvey['spotlight'] = 0;
        }else if( $dataSurvey['spotlight'] != 1 && $dataSurvey['spotlight'] != 0)
                $dataSurvey['spotlight'] = 0;

        if(!isset($dataSurvey['capa'])){
                $dataSurvey['capa'] = 0;
        }else if( $dataSurvey['capa'] != 1 &&  $dataSurvey['capa'] != 0)
            $dataSurvey['capa'] = 0;

        $dataSurvey['slug'] = str_replace(" ","-",$dataSurvey['title']);
        $dataSurvey['user_id'] = Auth::id();

        //foi configurado um diretório para a imagem em fillesystem config.

        //pega a imagem
        if($request->hasFile('image')){
            $image = $request->file('image');

            $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs('surveys',$nameImage);
            $dataSurvey['image'] = $nameImage;
        }

        Survey::create($dataSurvey);

        return redirect()->route('surveis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $survey= $this->survey->find($id);
        $options = $survey->options()->paginate(8);
        return view('administrator.module_option.indexModuleOption',compact('options','survey'));
    }

    public function searchSurveyOption($id, Request $request){
        $survey = $this->survey->find($id);
        $options = Option::where([['survey_id','=',$survey->id],['title','like','%'.$request->searchIndexModuleOption.'%']])->paginate(8);
        return view('administrator.module_option.indexModuleOption',compact('options','survey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $survey = $this->survey->find($id);
        $categories = $this->category->all();
        return view('administrator.module_survey.createEditModuleSurvey',compact('survey','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(SurveyCreateRequest $request, $id){
        $dataSurvey = $request->all();
        //dd($dataSurvey);
        if(!isset($dataSurvey['status'])){
            $dataSurvey['status'] = 0;
        }else if( $dataSurvey['status'] != 1 &&  $dataSurvey['status'] != 0)
            $dataSurvey['status'] = 0;

        if(!isset($dataSurvey['spotlight'])){
                $dataSurvey['spotlight'] = 0;
        }else if( $dataSurvey['spotlight'] != 1 && $dataSurvey['spotlight'] != 0)
                $dataSurvey['spotlight'] = 0;

        if(!isset($dataSurvey['capa'])){
                $dataSurvey['capa'] = 0;
        }else if( $dataSurvey['capa'] != 1 &&  $dataSurvey['capa'] != 0)
            $dataSurvey['capa'] = 0;

            if(!isset($dataSurvey['inSession'])){
                    $dataSurvey['inSession'] = 0;
            }else if( $dataSurvey['inSession'] != 1 &&  $dataSurvey['inSession'] != 0)
                $dataSurvey['inSession'] = 0;


        $survey = $this->survey->find($id);
        $dataSurvey['slug'] = str_replace(" ","-",$dataSurvey['title']);
        $dataSurvey['user_id'] = Auth::id();

        if( !isset($dataSurvey['remove_image']) ){
            if($request->hasFile('image')){
                $image = $request->file('image');
                if(empty($survey->image)){
                    $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                }else{
                    $nameImage = $survey->image;
                }
                $image->storeAs('surveys',$nameImage);
                $dataSurvey['image'] = $nameImage;
            }
        }else{
            Storage::disk('local')->delete('surveys/'.$survey->image);
            $dataSurvey['image'] = null;
        }
        if($survey->update($dataSurvey));
            return redirect()->route('surveis.index');
        return redirect()->route('surveis.edit',['id' => $id])->withErrors('Erro ao editar')->withInput();


    }

    public function surveyModuleFormDelete($id){
        $survey = $this->survey->find($id);
        return view('administrator.module_survey.deleteModuleSurvey',compact('survey'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $survey = $this->survey->find($id);
        Storage::disk('local')->delete('surveys/'.$survey->image);
        $survey->delete();
        return redirect()->route('surveis.index');
    }
}
