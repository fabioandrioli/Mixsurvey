<?php

namespace App\Http\Controllers;

use App\Newletter;
use Illuminate\Http\Request;
use App\Http\Requests\NewletterRequest;

class NewletterController extends Controller
{

    private $letter;

    public function __construct(Newletter $letter){
        $this->middleware('can:Administrador');
        $this->letter = $letter;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if(!$request->searchIndexModuleLetter)
            $letters = $this->letter->orderBy('id', 'DESC')->paginate(8);
        else{
            $letters = $this->letter->letterSearch($request->searchIndexModuleLetter);
        }
        return view('administrator.module_newsletter.indexModuleNewsletter',compact('letters'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewletterRequest $request){
        if($this->letter->create(['email' => $request->email]))
            return redirect()->back()->with(['msg' => 'Registrado com sucesso. Agradecemos.']);
        else
            return redirect()->back()->withErrors('Desculpe algo deu errado em nossa base.')->withInput();
    }

    public function formDelete($id){
        $letter = $this->letter->find($id);
        return view('administrator.module_newsletter.deleteModuleLetter',compact('letter'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Newletter  $newletter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if($letter = $this->letter->find($id)){
            $letter->delete();
            return redirect()->route('letters.index');
        }else{
            return redirect()->back()->withInput();
        }
    }
}
