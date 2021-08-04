<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Survey;
use App\Http\Requests\CategoryCreateRequest;

class CategoryController extends Controller
{

    private $category;

    public function __construct(Category $category){
        $this->middleware('can:Administrador');
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(!$request->searchIndexModuleCategory)
            $categories = $this->category->orderBy('id', 'DESC')->paginate(8);
        else{
            $categories = $this->category->categorySearch($request->searchIndexModuleCategory);
        }
        return view('administrator.module_category.indexModuleCategory',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('administrator.module_category.createEditModuleCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request){
        if(isset($request->title) && isset($request->description)){
            $request['slug'] = str_replace(" ","-",$request->title);
            $request['user_id'] = 1;
            $this->category->create($request->all());
        }else
            return redirect()->back()->with('error', 'Something went wrong.');
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $category = $this->category->find($id);
        $surveis = $category->surveis()->paginate(8);
        return view('administrator.module_survey.indexModuleSurvey',compact('surveis','category'));
    }

    public function searchCategorySurvey($id, Request $request){
        if($category = $this->category->find($id)){
            $surveis = Survey::where([['category_id','=',$category->id],['title','like','%'.$request->searchIndexModuleSurvey.'%']])->paginate(8);
            return view('administrator.module_survey.indexModuleSurvey',compact('surveis','category'));
        }else
            return redirect()->back()->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       if($category = $this->category->find($id)){
         return view('administrator.module_category.createEditModuleCategory',compact('category'));
       }else{
            return redirect()->back()->withInput();
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryCreateRequest $request,$id){
        if(isset($request->title) && isset($request->description)){
            $category = $this->category->find($id);
            $category->update($request->all());
        }else
            return redirect()->back()->with('error', 'Something went wrong.');
        return redirect()->route('categories.index');
    }

    public function categoryModuleFormDelete($id){
        if($category = $this->category->find($id))
            return view('administrator.module_category.deleteModuleCategory',compact('category'));
        else
            return redirect()->back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if($category = $this->category->find($id)){
            $category->sotfDelete();
            return redirect()->route('categories.index');
        }else{
            return redirect()->back()->withInput();
        }
    }
}
