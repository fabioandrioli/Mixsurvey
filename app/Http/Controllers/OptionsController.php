<?php

namespace App\Http\Controllers;

use App\Option;
use App\Survey;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\OptionCreateRequest;
use App\Http\Requests\OptionEditRequest;

class OptionsController extends Controller
{

    protected $option;
    public function __construct(Option $option){
        $this->middleware('can:Administrador');
        $this->option = $option;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(!$request->searchIndexModuleOption)
            $options = $this->option->orderBy('id', 'DESC')->paginate(8);
        else{
            $options = $this->option->optionSearch($request->searchIndexModuleOption);
        }return view('administrator.module_option.indexModuleOption',compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){
        if($survey = Survey::find($id))
            return view('administrator.module_option.createEditModuleOption',compact('survey'));
        else
            return redirect()->back()->withInput();
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionCreateRequest $request){
        $dataOption = $request->all();
        if($request->hasFile('image')){
            $image = $request->file('image');

            $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();

            $upload = $image->storeAs('options',$nameImage);
            $dataOption['image'] = $nameImage;
        }

        Option::create($dataOption);
        return redirect()->route('surveis.show',$request->survey_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Options  $options
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Options  $options
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        if($option = $this->option->find($id))
            return view('administrator.module_option.createEditModuleOption',compact('option'));
        else
            return redirect()->back()->withInput();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Options  $options
     * @return \Illuminate\Http\Response
     */
    public function update(OptionEditRequest $request,$id){
        $dataOption = $request->all();

        $option = $this->option->find($id);
        if(!isset($dataOption['remove_image'])){
            if($request->hasFile('image')){
                $image = $request->file('image');
                if(empty($option->image))
                    $nameImage = uniqid(date('YmdHis')).'.'.$image->getClientOriginalExtension();
                else
                    $nameImage = $option->image;
                $upload = $image->storeAs('options',$nameImage);
                $dataOption['image'] = $nameImage;
            }

            $option = $this->option->find($id);
        }else{
            Storage::disk('local')->delete('options/'.$option->image);
            $dataOption['image'] = null;
        }
        $option->update($dataOption);
        return redirect()->route('options.index');
    }

    public function optionModuleFormDelete($id){
        $option = $this->option->find($id);
        return view('administrator.module_option.deleteModuleOption',compact('option'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Options  $options
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if($option = $this->option->find($id)){
            Storage::disk('local')->delete('options/'.$option->image);
            $option->delete();
            return redirect()->route('options.index');
        }else{
            return redirect()->back()->withInput();
        }
    }
}
