<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    protected $video;

    public function __construct(Video $video){
        $this->middleware('can:Administrador');
        $this->video = $video;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(!$request->searchIndexModuleVideo)
            $videos = $this->video->orderBy('id', 'DESC')->paginate(8);
        else{
            $videos = $this->video->videoSearch($request->searchIndexModuleVideo);
        }
        return view('administrator.module_video.indexModuleVideo',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $videos = $this->video->all();
        return view('administrator.module_video.createEditModuleVideo');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        if(isset($request->title) && isset($request->description)){
            $this->video->create($request->all());
        }else
            return redirect()->back()->with('error', 'Something went wrong.');
        return redirect()->route('videos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $video = $this->video->find($id);
        return view('administrator.module_video.createEditModuleVideo',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        if(isset($request->title) && isset($request->description)){
            $video = $this->video->find($id);
            $video->update($request->all());
        }else
            return redirect()->back()->with('error', 'Something went wrong.');
        return redirect()->route('videos.index');
    }

    public function videoModuleFormDelete($id){
        $video = $this->video->find($id);
        return view('administrator.module_video.deleteModuleVideo',compact('video'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $video = $this->video->find($id);
        $video->delete();
        return redirect()->route('videos.index');
    }
}
