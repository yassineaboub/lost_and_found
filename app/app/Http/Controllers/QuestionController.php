<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use Barryvdh\Debugbar\DataCollector\QueryCollector;
use Illuminate\Support\Facades\DB;
use App\Objet;
use App\Category;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $req){

        $count=  DB::table('question')
            ->where('id_category','=',$req->categorie)
            ->where('id_obj','=',$req->obj)
            ->where('question','=',$req->quest)
            ->count();


        if($count == 0){
            $quest= new Question();
            $quest->question =$req->quest;
            $quest->id_obj  = $req->obj;
            $quest->id_category  = $req->categorie;

            $quest->save();
            return back()->with('success','Ajouter avec success');
        }
        else{
            return back()->with('error','question existe deja');
        }


    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::all();
        $object = Objet::all();
        $questions = DB::table('question')
            ->join('category', 'question.id_category', '=', 'category.id_cat')
            ->join('objet', 'question.id_obj', '=', 'objet.id_objet')
            ->select('category.*', 'question.*', 'objet.*')
            ->get();
        $question_update= DB::table('question')
        ->select('question.*')
        ->where('id_quest', '=', $id)
        ->get();
        return view('admin/question', compact('object', 'category','questions','question_update'));
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
        DB::table('question')
        ->where('id_quest','=',$id)
        ->update(['question' => $request->quest ]);
        return back()->with('success', 'mise a éte bien enregistrer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $count = DB::table('reponse')
            ->where('id_que', '=', $id)
            ->count();
        $count1 = DB::table('annonce')
            ->where('id_question0', '=', $id)
            ->orWhere('id_question1', '=', $id)
            ->orWhere('id_question2', '=', $id)
            ->count();
        if ($count == 0 && $count1 == 0) {
            DB::table('question')
                ->where('id_quest', '=', $id)
                ->delete();
            return back()->with('success', 'supprimer avec success');
        } else {
            return back()->with('error', 'impossible de supprimer');
        }
    }
}
