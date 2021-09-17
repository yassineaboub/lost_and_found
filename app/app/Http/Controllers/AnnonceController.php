<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\Category;
use App\Correct;
use App\Objet;
use App\Question;
use App\Region;
use App\User;
use App\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AnnonceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $category = Category::all();
        $object = Objet::all();
        $ann = Annonce::all();
        return view('annonce.search', compact('category', 'object', 'ann'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mesAnnonce()
    {
        $id_user = auth()->user()->id;
        $ann = DB::table('annonce')->where('id_user_ann', $id_user)->get();
        return view('annonce.listannonce', compact('ann'));
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $req)
    {
        $ann = new Annonce();
        $id_user = auth()->user()->id;

        if ($req->hasFile('image')) {
            $fileext = $req->file('image')->getClientOriginalName();
            $filename = pathinfo($fileext, PATHINFO_FILENAME);
            $ext = $req->file('image')->getClientOriginalExtension();
            $FileNameStore = $filename . '_' . time() . '.' . $ext;
            $path = $req->file('image')->storeAs('annonce', $FileNameStore);
            $ann->image = $path;
        }

        if ($req->datefin != '') {
            $ann->datefin = $req->datefin;
        }
        $ann->dateaction = $req->date;
        $ann->description = $req->desc;
        $ann->etat = $req->etat;
        $ann->nom = $req->nom;
        $ann->ville = $req->ville;
        $ann->region = $req->region;
        $ann->lattitude = $req->lat;
        $ann->longitude = $req->lng;
        $ann->id_user_ann = $id_user;
        $ann->id_object = $req->obj;
        // $id = DB::getPdo()->lastInsertId();
        //for($i =0; $i<=2;$i++){
        $ann->id_reponse0 = $req->input('reponse-0');
        $ann->id_question0 = $req->input('question-0');
        $ann->id_reponse1 = $req->input('reponse-1');
        $ann->id_question1 = $req->input('question-1');
        $ann->id_reponse2 = $req->input('reponse-2');
        $ann->id_question2 = $req->input('question-2');

        // }
        $ann->save();
        return back()->with('success', 'ajouter effctuée avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *  * @return \Illuminate\Http\Response
     */
    public function searchobj(Request $req)
    {
        $obj = $req->object;
        $cat = $req->category;
        $ville = $req->ville;

        if ($obj != "please choose" && $cat != "please choose") {

            $ann = DB::table('annonce')

                ->join('objet', 'annonce.id_object', '=', 'objet.id_objet')
                ->select('annonce.*', 'objet.*')
                ->where('annonce.id_object', '=', $obj)
                ->where('objet.id_category', '=', $cat)
                ->get();
            $category = Category::all();
            $object = Objet::all();
            return view('annonce.search', compact('category', 'object', 'quest', 'ann'));
        } else if ($cat != "please choose") {

            $ann = DB::table('annonce')
                ->join('objet', 'annonce.id_object', '=', 'objet.id_objet')
                ->select('annonce.*', 'objet.*')
                ->where('objet.id_category', '=', $cat)
                ->get();
            $category = Category::all();
            $object = Objet::all();
            return view('annonce.search', compact('category', 'object', 'quest', 'ann'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *  * @return \Illuminate\Http\Response
     */
    public function searchplace(Request $req)
    {
        $ville = $req->ville;

        if ($ville != "") {
            $ann = DB::table('annonce')
                ->join('objet', 'annonce.id_object', '=', 'objet.id_objet')
                ->select('annonce.*')
                ->where('annonce.ville', 'like', $ville)
                ->get();

            $category = Category::all();
            $object = Objet::all();
            return view('annonce.search', compact('category', 'object', 'ann'));

        }
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detail($id)
    {
        $id_user = auth()->user()->id;
        $id_annonce = $id;
        $hideann = DB::table('annonce')
            ->where('id_user_ann', '=', $id_user)
            ->where('id_annonce', '=', $id)
            ->count();

        $ann = DB::table('annonce')
            ->join('objet', 'annonce.id_object', '=', 'objet.id_objet')
            ->select('annonce.*', 'objet.*')
            ->where('annonce.id_annonce', '=', $id)
            ->get();

        $hidesignal = DB::table('signaler')
            ->select('signaler.*')
            ->where('signaler.id_user', '=', $id_user)
            ->where('signaler.id_ann', '=', $id_annonce)
            ->count();

        foreach ($ann as $value) {
            $quest0 = $value->id_question0;
            $quest1 = $value->id_question1;
            $quest2 = $value->id_question2;
        }
        $qus0 = DB::table('question')
            ->select('question.*')
            ->where('id_quest', '=', $quest0)
            ->get();

        $qus1 = DB::table('question')
            ->select('question.*')
            ->where('id_quest', '=', $quest1)
            ->get();
        $qus2 = DB::table('question')
            ->select('question.*')
            ->where('id_quest', '=', $quest2)
            ->get();

        $question = [];
        array_push($question, $qus0);
        array_push($question, $qus1);
        array_push($question, $qus2);

        $rep0 = DB::table('reponse')
            ->select('reponse.*')
            ->where('id_que', '=', $quest0)
            ->get();

        $rep1 = DB::table('reponse')
            ->select('reponse.*')
            ->where('id_que', '=', $quest1)
            ->get();
        $rep2 = DB::table('reponse')
            ->select('reponse.*')
            ->where('id_que', '=', $quest2)
            ->get();
        $reponse = [];
        array_push($reponse, $rep0);
        array_push($reponse, $rep1);
        array_push($reponse, $rep2);

        $correctanswer = DB::table('correct')
            ->join('users', 'correct.id_user', '=', 'users.id')
            ->select('correct.*','users.*')
            ->where('id_ann', '=', $id)
            ->get();

        return view('annonce.detail', compact('ann', 'reponse', 'question', 'hideann', 'id_annonce','correctanswer','hidesignal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $update_ann = DB::table('annonce')->where('id_annonce', $id)->get();
        foreach ($update_ann as $value) {
            if ($value->etat == 'trouvé') {
                $category = Category::all();
                $object = Objet::all();
                $quest = Question::all();
                return view('utilisateur.found', compact('category', 'object', 'quest', 'update_ann'));
            } else if ($value->etat == 'perdu') {
                $category = Category::all();
                $object = Objet::all();
                $quest = Question::all();
                return view('utilisateur.lost', compact('category', 'object', 'quest', 'update_ann'));
            }

        }
    }

    /**
     * searchplace .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveanswer(Request $request)
    {
        $id_user = auth()->user()->id;
        $quest0 = $request->quetion0;
        $rep0 = $request->reponse0;
        $quest1 = $request->quetion1;
        $rep1 = $request->reponse1;
        $quest2 = $request->quetion2;
        $rep2 = $request->reponse2;
        $id = $request->idannonce;
        $count = DB::table('annonce')
            ->where('id_annonce', '=', $id)
            ->where('id_reponse0', '=', $rep0)
            ->where('id_reponse1', '=', $rep1)
            ->where('id_reponse2', '=', $rep2)
            ->where('id_question0', '=', $quest0)
            ->where('id_question1', '=', $quest1)
            ->where('id_question2', '=', $quest2)
            ->count();

        if ($count > 0) {
            $correct = new Correct();
            $correct->id_user = $id_user;
            $correct->id_ann = $id;
            $correct->save();
            return back()->with('success', 'votre reponse a ete bien enregistré');
        } else {
            return back()->with('error', 'votre reponse a ete bien enregistré');
        }

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

        if ($request->hasFile('image')) {
            $fileext = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($fileext, PATHINFO_FILENAME);
            $ext = $request->file('image')->getClientOriginalExtension();
            $FileNameStore = $filename . '_' . time() . '.' . $ext;
            $path = $request->file('image')->storeAs('annonce', $FileNameStore);
        }
        DB::table('annonce')
            ->where('id_annonce', '=', $id)
            ->update(['nom' => $request->nom, 'description' => $request->desc, 'lattitude' => $request->lat, 'longitude' => $request->lng, 'ville' => $request->ville, 'region' => $request->region, 'etat' => $request->etat]);
        $id_user = auth()->user()->id;
        $ann = DB::table('annonce')->where('id_user_ann', $id_user)->get();

        return view('annonce.listannonce', compact('ann'))->with('success', ' mise a jour effectue avec success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
         $count = DB::table('signaler')
        ->where('id_ann', '=', $id)
        ->count();
        $count1 = DB::table('notifiation')
        ->where('id_ann_notif', '=', $id)
        ->count();
        $count2 = DB::table('correct')
        ->where('id_ann', '=', $id)
        ->count();
      
        if ($count == 0 && $count1 == 0 && $count2 == 0) {
           
            DB::table('annonce')
                ->where('id_annonce', '=', $id)
                ->delete();
            return back()->with('success', 'supprimer avec success');
        } else {
            return back()->with('error', 'votre reponse a ete bien enregistré');
        }
        return back()->with('error', 'impossible de supprimer');
    }
}
