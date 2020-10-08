<?php

namespace App\Http\Controllers;

use App\Vocabulary;
use App\VocabularyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;

class VocabularyController extends Controller
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

    public function categoryIndex()
    {
        # code...
        $collection = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id);
        $asstypes = Vocabulary::all()->where("type_id",VocabularyType::where("code","ASS-TYP")->first()->id);
        return view("pages.category",compact("collection","asstypes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function categoryStore(Request $request)
    {
        //
        //    dd(Vocabulary::all()->where("type_id",VocabularyType::where("code","ASS-TYP")->first()->id)->pluck("code"));

        $parameters = $request->validate([
            "code" => [ Rule::notIn(Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id)->pluck("code")), "required" ],
            "label" => [ Rule::notIn(Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id)->pluck("label")), "required" ],
            "asstyp" => [ Rule::In(Vocabulary::all()->where("type_id",VocabularyType::where("code","ASS-TYP")->first()->id)->pluck("code")), "required" ],

        ]);
        $category = new Vocabulary();
        $category->code = $parameters["code"];
        $category->label = $parameters["label"];
        $category->attribute = json_encode(["ASS-TYP" => $parameters["asstyp"]]);
        $category->type_id = VocabularyType::where("code","PDT-TYP")->first()->id;

        $category->save();
        Session::put('success',"Nouvelle catégorie paramétrée");
        return redirect()->route("category.list");
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vocabulary  $category
     * @return \Illuminate\Http\Response
     */
    public function categoryUpdate(Request $request,Vocabulary $category)
    {
        //

        $parameters = $request->validate([
            "label" => [ Rule::notIn(Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id)->except($category->id)->pluck("label")), "required" ],
            "asstyp" => [Rule::In(Vocabulary::all()->where("type_id",VocabularyType::where("code","ASS-TYP")->first()->id)->pluck("code")), "required" ],

        ]);

        $newcategory = clone $category;
        $newcategory->label = $parameters["label"];
        $newcategory->attribute = json_encode(["ASS-TYP" => $parameters["asstyp"]]) ;

        $newcategory->save();
        Session::put("success","Catégorie paramétrée avec succès");
        return redirect()->route("category.list");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vocabulary  $category
     * @return \Illuminate\Http\Response
     */
    public function categoryEdit(Vocabulary $category)
    {
        //

        $collection = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id);
        $asstypes = Vocabulary::all()->where("type_id",VocabularyType::where("code","ASS-TYP")->first()->id);
        return view("pages.category",compact("collection","asstypes","category"));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function categoryDestroy(Vocabulary $category)
    {
        //
        if(!(Vocabulary::all()->where("parent",$category->id)->count() !==0 ))
        {
            $category->delete();
            Session::put('success',"Catégorie supprimée avec succès.");
        } else {
            Session::put('warning',"Attention! La catégorie est utilisée.");
        }

        return redirect()->route("category.list");

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
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function show(Vocabulary $vocabulary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function edit(Vocabulary $vocabulary)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vocabulary $vocabulary)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vocabulary $vocabulary)
    {
        //
    }

    public function allForOneVocabulary(Vocabulary $vocabulary)
    {
        # code...


        $vocabularies = Vocabulary::all()->where('parent',$vocabulary->id);
        return response()->json($vocabularies);

    }
}
