<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Option;
use App\Video;
use App\User;
use App\Role;
use App\Category;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EmailResquest;
use App\Mail\ContactMail;
use App\Mail\SendPasswordCreateUser;
use App\Mail\ForgetPasswordMail;
use Mail;
use App\Http\Requests\UserGuestRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;
use Datetime;

class SiteController extends Controller
{

    protected $survey;
    protected $video;
    protected $option;
    protected $user;

    public function __construct(Survey $survey, Video $video,Option $option, User $user){
        $this->survey = $survey;
        $this->video = $video;
        $this->option = $option;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //searchNavbar
    public function index(Request $request){

            //dd(date('Y-m-d'));
            $optionsMostVoted = Option::mostVoted();

            if(!$request->searchNavbar)
                $surveis = $this->survey->where('status',true)->orderBy('id', 'DESC')->paginate(4);
            else{
                $surveis = $this->survey->surveySearchSite($request->searchNavbar);
            }

            $destaques = $this->survey->destaques();
            $videos = $this->video->orderBy('id', 'DESC')->paginate(4);
            return view("site.survey.listSurveis",compact('surveis','videos','optionsMostVoted','destaques'));

    }

    public function searchCategory($slug){

        if($category = Category::where('slug',$slug)->first()){
            $category->views = $category->views + 1;
            $category->update();
            $optionsMostVoted = Option::mostVoted();
            $surveis = $category->surveis()->where('status',true)->paginate(4);
            $videos = $this->video->orderBy('id', 'DESC')->paginate(4);
            $destaques = $this->survey->destaques();
            $title = $category->title;
            return view("site.survey.listSurveis",compact('surveis','videos','optionsMostVoted','destaques','title'));
        }else{
            return view("errors.404");
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function login(){
        return view('site.user_guest.login');
    }

    public function create(){
        if(!Auth::check())
            return view('site.user_guest.register');
        else
            return redirect()->route('site.login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserGuestRequest $request)
    {

        if(!Auth::check()){
            $dataGuestUser = $request->all();
            $dataGuestUser['password'] = rand(1,30)%2;
            // Mail::to('fabio.drioli@gmail.com')->send(new SendPasswordCreateUser( $dataGuestUser['password']));
            // dd();

            $dataGuestUser['role_id'] = Role::where('title','Convidado')->first()->id;
            for ($i=0; $i<7; $i++) {
                $dataGuestUser['password'] = $dataGuestUser['password']. chr(rand(65,90));
            }

            $dataGuestUser['senha'] = $dataGuestUser['password'];
            $dataGuestUser['password'] = bcrypt($dataGuestUser['password']);

            if($this->user->create([
                'name' => $dataGuestUser['name'],
                'email' => $dataGuestUser['email'],
                'password' => $dataGuestUser['password'],
                'role_id' => $dataGuestUser['role_id'],
            ])){
                Mail::to($dataGuestUser['email'])->send(new SendPasswordCreateUser( $dataGuestUser['senha']));
                return redirect()->route('site.login');
            }else{
                return redirect()->route('site.create')->with(['errors' => 'Algo deu errado, entre em contado com o suporte']);
            }
        }else{
            return redirect()->route('site.login');
        }
    }

    public function forgetPasswordForm(){
        return view('site.user_guest.forgetPassword');
    }

    public function forgetEmailStore(Request $request){
        if(!Auth::check()){
            $dataGuestUser = $request;
            $user = $this->user->where('email',$dataGuestUser['email'])->first();
            for ($i=0; $i<7; $i++) {
                $dataGuestUser['password'] = $dataGuestUser['password']. chr(rand(65,90));
            }
            $dataGuestUser['senha'] = $dataGuestUser['password'];
            $dataGuestUser['password'] = bcrypt($dataGuestUser['password']);
            if($user->update([
                'password' => $dataGuestUser['password']
            ])){
                Mail::to($dataGuestUser['email'])->send(new ForgetPasswordMail( $dataGuestUser['senha']));
                return redirect()->route('site.login');
            }else{
                return redirect()->route('site.forgetPasswordForm')->withErrors('Algo deu errado, entre em contado com o suporte')->withInput();
            }
        }else{
            redirect()->route('site.login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug){

            //$this->roles->contains('name', $role);
            //Auth::user()->surveys->contains('id',$survey->id)
            if($survey = Survey::where('slug',$slug)->first()){
                $survey->views = $survey->views + 1;
                $survey->update();
                $optionsMostVoted = Option::mostVoted();
                $surveis = $this->survey->orderBy('id', 'DESC')->paginate(4);
                $videos = $this->video->orderBy('id', 'DESC')->paginate(4);
                $destaques = $this->survey->destaques();
                return view("site.survey.showSurvey",compact('survey','videos','surveis','optionsMostVoted','destaques'));
            }else{
                return view("errors.404");
            }

    }

    public function contacts(){
        return view('site.user_guest.contacts');
    }

    public function contactStore(EmailResquest $request){
        $data = $request->all();
        Mail::to('fabio.drioli@gmail.com')->send(new ContactMail($data));
        return redirect()->route('site.contacts');

        // Mail::send('site.email_site_contact', $data, function($message) use ($data) {
        //     $message->from($data['email'], $data['nome']);
        //     $message->to('fabio.tads15@gmail.com') ->subject($data['assunto']);
        // });

        return redirect()->route('site.contacts');

    }


    public function aboutUs(){
        return view('site.user_guest.aboutUs');
    }

    public function resultsSurvey(Request $request){
        $tokenCaptcha = $request->gRecaptchaResponse;

        if($tokenCaptcha){
            $client = New Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify',[
                'form_params' => array(
                    'secret'    => '6LfmDqUZAAAAAJ6RNLstDrcC9p2-41_hDrRao-dS',
                    'response'  => $tokenCaptcha,
                )
            ]);

            $result = json_decode($response->getBody()->getContents());

            if($result->success){
                    if($option = Option::find($request->option_id)){
                        if($option->survey->status){
                            if($option->survey->inSession && Auth::check() &&  (date($option->survey->start_date) <= date('Y-m-d') && date($option->survey->finish_date) >= date('Y-m-d')) ){ // verifica se o usuário está logado e se a enquete so pode ser votada logada.
                                $survey = $this->votoVerify($option);
                                $survey->users()->syncWithoutDetaching(Auth::user()->id);
                                $option->users()->syncWithoutDetaching(Auth::user()->id);
                                return response()->json(['message_success' => "Registrado com sucesso","vote"=> true,"options" => $survey->options()->orderBy('votes','desc')->get()]);
                            }else if(!$option->survey->inSession && (date($option->survey->start_date) <= date('Y-m-d') && date($option->survey->finish_date) >= date('Y-m-d'))){
                                $survey = $this->votoVerify($option);
                                return response()->json(['message_success' => "Registrado com sucesso", "vote" => true,"options" => $survey->options()->orderBy('votes','desc')->get()]);
                            }
                            return response()->json(["error" => "user not logged or date of survey expired"]);
                        }
                    }else{
                        return response()->json(['error' => 'Option not found'],400);
                    }

            }else{
                return response()->json(['erro' => 'Token captcha has used']);
            }
        }
        else
            return response()->json(['error' => 'Ative o recaptcha'],400);
    }

    public function resultsSession($id){
        $survey = $this->survey->find($id);
        if(!$survey->inSession){
            return response()->json(["options" => $survey->options()->orderBy('votes','desc')->get()]);
        }
    }

    private function votoVerify($option){
        $option->votes = $option->votes + 1;
        $option->update();
        $survey = $option->survey;
        return $survey;
    }

    public function search(Request $request){
        if($options = $this->option->optionSearchSite($request->search,$request->id)){
            return response()->json(['options' => $options]);
        }else{
            return response()->json(['error' => 'Option not found'],400);
        }
    }


    public function refreshOptionsFromResults($id){
        $option = Option::find($id);
        $survey = $option->survey;
        return response()->json(['options' => $survey->option]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
