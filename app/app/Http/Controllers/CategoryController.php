<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use App\Category;

class CategoryController extends Controller
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
        $count=  DB::table('category')
            ->where('nom_category','=',$req->nomcat)
            ->count();

        if($count == 0){
            $category = new Category() ;
            $category->nom_category=$req->nomcat;
            $category->save();
            return back()->with('success','Ajouter avec success');
        }
        else{
            return back()->with('error','categorie existe deja');
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
       $category_update= DB::table('category')
       ->select('category.*')
       ->where('id_cat', '=', $id)
       ->get();
       return view('admin/category',compact('category','category_update'));
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
        DB::table('category')
        ->where('id_cat','=',$id)
        ->update(['nom_category' => $request->nomcat ]);
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
     $count=  DB::table('objet')
     ->where('id_category','=',$id)
     ->count();
     
     if($count == 0){
        DB::table('category')
        ->where('id_cat','=',$id)
        ->delete();
        return back()->with('success','supprimer avec success');
     }
     else{
        return back()->with('error','impossible de supprimer');
     }

    }
}
