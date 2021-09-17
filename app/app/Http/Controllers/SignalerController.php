<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Signaler;
use Illuminate\Support\Facades\DB;

class SignalerController extends Controller
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
       
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $signaler = new Signaler();
        $id_user = auth()->user()->id;
        $signaler->id_user  = $id_user;
        $signaler->id_ann  = $request->id_ann;
        $signaler->cause  = $request->cause;
        $signaler->save();
       


        DB::table('annonce')->increment('nb_signal');
        return back()->with('success','signale avec success');

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
        $idann= DB::table('signaler')
        ->select('signaler.*')
        ->where('id_signale','=',$id)
        ->get();
        foreach ($idann as  $value) {
           $id_annonce = $value->id_ann;   
        }
        DB::table('correct')
        ->where('id_ann','=',$id_annonce)
        ->delete();

        DB::table('signaler')
        ->where('id_ann','=',$id_annonce)
        ->delete();

        DB::table('annonce')
        ->where('id_annonce','=',$id_annonce)
        ->delete();
        return back()->with('success',"l'annonce a éte supprimer avec success");
        
    }
}
