<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Charts\SurveyChart;
use App\Charts\CategoryChart;
use App\Option;
use App\Category;
use App\Survey;
use App\User;
use App\Role;
use App\Newletter;

class StatistcsController extends Controller
{
    private $option;
    private $category;
    private $survey;
    private $letter;
    public function __construct(Option $option,Category $category,Survey $survey,Newletter $letter){
        $this->middleware('can:Administrador');
        $this->option = $option;
        $this->category = $category;
        $this->survey = $survey;
        $this->letter = $letter;
    }

    public function index(){

        $chart = new SurveyChart;
        $roleGuesty = Role::where('title','Convidado')->first();

        $roleAdministrator = Role::where('title','Administrador')->first();

        $userGuestCount = $roleGuesty->users()->count();
        $userAdministratorCount = $roleAdministrator->users()->count();

        $countUser = User::all()->count();

        $letterCount = $this->letter->count();
        $mostVoted = $this->option->mostVoted(6);
        $total = 0;
        $qtd[] = 0;
        foreach ($mostVoted as  $vote) {
            $chart->labels[] = strrchr($vote->survey->title,' ');
            $qtd[] = $vote->total;
            $total = $total + $vote->total;
        }

        $chart->dataset('Mais votadas | Total: '.$total,'bar',$qtd)->options(['backgroundColor' => '#'.dechex(rand(0x000000, 0xffffff))]);

        $categoryChart = new  CategoryChart;

        $viewTotal = 0;
        $categories = $this->category->mostViews();
        foreach($categories as  $category){
            $categoryChart->labels[] = $category->title;
            $qtdViewsCategory[] = $category->views;
            $viewTotal = $viewTotal + $category->views;
        }

        $categoryChart->dataset('Categorias mais Visualizadas | Total: '.$viewTotal,'bar', $qtdViewsCategory)->options(['backgroundColor' => '#'.dechex(rand(0x000000, 0xffffff))]);

        $viewSurveyTotal = 0;
        $chartSurvey = new SurveyChart;
        $surveys = $this->survey->mostViews();
        foreach($surveys as  $survey){
            $chartSurvey->labels[] = strrchr($survey->title,' ');
            $qtdViews[] = $survey->views;
            $viewSurveyTotal = $viewSurveyTotal + $survey->views;
        }

        $chartSurvey->dataset('Enquetes mais Visualizadas | Total: '.$viewSurveyTotal,'bar', $qtdViews)->options(['backgroundColor' => '#'.dechex(rand(0x000000, 0xffffff))]);

        return view("administrator.module_statistics.indexModuleStatistics",compact('chart','categoryChart','chartSurvey','countUser','userGuestCount','userAdministratorCount','letterCount'));
    }

}
