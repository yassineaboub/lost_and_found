<?php

namespace App\Http\Controllers;

use App\Category;
use App\Objet;
use App\Region;
use App\User;
use App\Ville;
use App\Signaler;
use App\Question;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function admin()
    {
        return view('admin.adminhome');
    }

    public function listuser()
    {
        $user = User::all();
        return view('admin/listuser', compact('user'));
    }

    public function category()
    {
        $category = Category::all();
        return view('admin/category', compact('category'));
    }

    public function ville()
    {
        $ville = Ville::all();
        return view('admin/ville', compact('ville'));
    }

    public function objet()
    {
        $category = Category::all();
        $objet = DB::table('objet')
            ->join('category', 'objet.id_category', '=', 'category.id_cat')
            ->select('category.*', 'objet.*')
            ->get();
        return view('admin/object', compact('category', 'objet'));
    }

    public function region()
    {
        $ville = Ville::all();
        $region = Region::all();
        return view('admin/region', compact('ville', 'region'));
    }

    public function question()
    {
        $category = Category::all();
        $object = Objet::all();
        $questions = DB::table('question')
            ->join('category', 'question.id_category', '=', 'category.id_cat')
            ->join('objet', 'question.id_obj', '=', 'objet.id_objet')
            ->select('category.*', 'question.*', 'objet.*')
            ->get();
        return view('admin/question', compact('object', 'category','questions'));
    }

    public function reponse()
    {
        $question = Question::all();
        $reponses = DB::table('reponse')
            ->join('question', 'reponse.id_que', '=', 'question.id_quest')
            ->select('reponse.*', 'question.*')
            ->get();
        return view('admin/reponse', compact('question','reponses'));
    }
    public function signaler()
    {

        $signals = DB::table('signaler')
            ->join('users', 'signaler.id_user', '=', 'users.id')
            ->join('annonce', 'signaler.id_ann', '=', 'annonce.id_annonce')
            ->select('signaler.*', 'users.*','annonce.nom AS nomA')
            ->get();
        return view('admin/notification', compact('signals'));
    }

    public function signalList(){
        $listsignal=  DB::table('signaler')
        ->join('annonce', 'signaler.id_ann', '=', 'annonce.id_annonce')
        ->select('signaler.*','annonce.*')
        ->get();
        return view('admin/signal',compact('listsignal'));
    }

}
