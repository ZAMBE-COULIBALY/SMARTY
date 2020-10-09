<?php

namespace App\Http\Controllers;

use App\Partner;
use App\Vocabulary;
use App\VocabularyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Exists;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

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
        $clmtypes = Vocabulary::all()->where("type_id",VocabularyType::where("code","CLM-TYP")->first()->id);

        return view("pages.category",compact("collection","asstypes","clmtypes"));
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
            "clmtyp" => ""

        ]);
        $category = new Vocabulary();
        $category->code = $parameters["code"];
        $category->label = $parameters["label"];
        $category->attribute = json_encode(["ASS-TYP" => $parameters["asstyp"],"CLM-TYP" => $parameters["clmtyp"]]);
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


    public function typeIndex()
    {
        # code...
        $collection = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id);
        $categories = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id);
        $clmtypes = Vocabulary::all()->where("type_id",VocabularyType::where("code","CLM-TYP")->first()->id);
        return view("pages.type",compact("collection","clmtypes","categories"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function typeStore(Request $request)
    {
        //
        //    dd(Vocabulary::all()->where("type_id",VocabularyType::where("code","ASS-TYP")->first()->id)->pluck("code"));

        $parameters = $request->validate([
            "code" => [ Rule::notIn(Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id)->pluck("code")), "required" ],
            "label" => [ Rule::notIn(Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id)->pluck("label")), "required" ],
            "category" => "required",
            "clmtyp" => ""
        ]);
        $type = new Vocabulary();
        $type->code = $parameters["code"];
        $type->label = $parameters["label"];
        $type->parent = $parameters["category"];
        $type->attribute = json_encode(["CLM-TYP" => $parameters["clmtyp"]]);
        $type->type_id = VocabularyType::where("code","PDT-KIND")->first()->id;

        $type->save();
        Session::put('success',"Nouvau type paramétré");
        return redirect()->route("type.list");
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vocabulary  $type
     * @return \Illuminate\Http\Response
     */
    public function typeUpdate(Request $request,Vocabulary $type)
    {
        //

        $parameters = $request->all();
        $parametersvd = $request->validate([
            "label" => [ Rule::notIn(Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id)->except($type->id)->pluck("label")), "required" ],

        ]);

        $newtype = clone $type;
        $type->label = $parametersvd["label"];
        $type->parent = $parameters["category"];
        $type->attribute = json_encode(["CLM-TYP" => $parameters["clmtyp"]]);
        $type->type_id = VocabularyType::where("code","PDT-KIND")->first()->id;

        $type->save();

        $newtype->save();
        Session::put("success","Type paramétrée avec succès");
        return redirect()->route("type.list");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vocabulary  $type
     * @return \Illuminate\Http\Response
     */
    public function typeEdit(Vocabulary $type)
    {
        //
        $collection = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id);
        $categories = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id);
        $clmtypes = Vocabulary::all()->where("type_id",VocabularyType::where("code","CLM-TYP")->first()->id);

        return view("pages.type",compact("collection","clmtypes","type","categories"));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vocabulary  $vocabulary
     * @return \Illuminate\Http\Response
     */
    public function typeDestroy(Vocabulary $type)
    {
        //
        if(!(Vocabulary::all()->where("parent",$type->id)->count() !==0 ))
        {
            $type->delete();
            Session::put('success',"Catégorie supprimée avec succès.");
        } else {
            Session::put('warning',"Attention! La catégorie est utilisée.");
        }

        return redirect()->route("type.list");

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

    public function allForOneVocabularyFromPartner(Vocabulary $vocabulary,$level,Partner $partner)
    {
        # code...

        switch ($level) {
            case '2':
                # code...
                $vocabularies = Vocabulary::all()->where('parent',$vocabulary->id)->whereIn("id",collect($partner->product->all())->pluck("label")->pluck("id"));

                break;
                case '3':
                    # code...
                    $vocabularies = Vocabulary::all()->where('parent',$vocabulary->id)->whereIn("id",collect($partner->product->all())->pluck("model")->pluck("id"));

                    break;
            default:
                # code...
                $vocabularies = Vocabulary::all()->where('parent',$vocabulary->id);
                break;
        }
        return response()->json($vocabularies);

    }
}
