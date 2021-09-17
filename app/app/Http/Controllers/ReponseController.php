<?php

namespace App\Http\Controllers;

use App\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Question;

class ReponseController extends Controller
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
        $question = Question::all();
        $reponses = DB::table('reponse')
            ->join('question', 'reponse.id_que', '=', 'question.id_quest')
            ->select('reponse.*', 'question.*')
            ->get();
        $reponse_update = DB::table('reponse')
            ->select('reponse.*')
            ->where('id_rep', '=', $id)
            ->get();
        return view('admin/reponse', compact('question', 'reponses','reponse_update'));
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
        DB::table('reponse')
        ->where('id_rep','=',$id)
        ->update(['reponse' => $request->rep ]);
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

        $count = DB::table('annonce')
            ->where('id_reponse0', '=', $id)
            ->orWhere('id_reponse1', '=', $id)
            ->orWhere('id_reponse2', '=', $id)
            ->count();
        if ($count == 0) {
            DB::table('reponse')
                ->where('id_rep', '=', $id)
                ->delete();
            return back()->with('success', 'supprimer avec success');
        } else {
            return back()->with('error', 'impossible de supprimer');
        }
    }
/**
 * Ajax return reponse a newly created resource in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
 */
    public function getreponse(Request $request)
    {

        $states = DB::table("reponse")
            ->where("id_que", '=', $request->idque)
            ->pluck("id_rep", "reponse");
        return response()->json($states);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $req){


        $count=  DB::table('reponse')
            ->where('id_que','=',$req->quetion)
            ->where('reponse','=',$req->rep)
            ->count();


        if($count == 0){
            $rep= new Reponse();
            $rep->reponse  =$req->rep;
            $rep->id_que  =$req->quetion;
            $rep->save();
            return back()->with('success','Ajouter avec success');
        }
        else{
            return back()->with('error','reponse existe deja');
        }


    }

}
