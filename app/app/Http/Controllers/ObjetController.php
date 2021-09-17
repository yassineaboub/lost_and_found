<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Objet;
use App\Category;

class ObjetController extends Controller
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
     public function add(Request $req){

         $count=  DB::table('objet')
             ->where('id_category','=',$req->category)
             ->where('nom_objet','=',$req->nomobjet)
             ->count();


         if($count == 0){
             $objet = new Objet() ;
             $objet->nom_objet  =$req->nomobjet;
             $objet->id_category = $req->category;
             $objet->save();
             return back()->with('success','Ajouter avec success');
         }
         else{
             return back()->with('error','objet existe deja');
         }

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
        $objet_update= DB::table('objet')
        ->select('objet.*')
        ->where('id_objet', '=', $id)
        ->get();
        $objet = DB::table('objet')
        ->join('category', 'objet.id_category', '=', 'category.id_cat')
        ->select('category.*', 'objet.*')
        ->get();
        return view('admin/object',compact('category','objet_update','objet'));
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

        DB::table('objet')
        ->where('id_objet','=',$id)
        ->update(['nom_objet' => $request->nomobjet ]);
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
        $count1=  DB::table('question')
        ->where('id_obj','=',$id)
        ->count();
        $count2=  DB::table('annonce')
        ->where('id_object','=',$id)
        ->count();
       
        if($count1 == 0  && $count2==0){
           DB::table('objet')
           ->where('id_objet','=',$id)
           ->delete();
           return back()->with('success','supprimer avec success');
        }
        else{
           return back()->with('error','impossible de supprimer');
        }
    }
}
