<?php

namespace App\Http\Controllers;

use App\Manager;
use App\Partner;
use App\Product;
use App\Role;
use App\User;
use App\Vocabulary;
use App\VocabularyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


use function GuzzleHttp\Promise\all;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usr = User::find(Auth::user()->id);

        $products = Product::all()->where("partner_id",$usr->manager->partner_id);


        // dd($products->first()->category);

        $categories = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-TYP")->first()->id)->whereIn('code',json_decode($usr->manager->partner->category));
        // $types = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-KIND")->first()->id);
        // $labels = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-LBL")->first()->id);
        // $models = Vocabulary::all()->where("type_id",VocabularyType::where("code","PDT-MDL")->first()->id);
        return view("pages.products",compact("products","categories"));
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

        $parameters = $request->except("_token");
        $product = new Product();

        $product->code = $parameters["code"];
        $product->name = $parameters["name"];

        $product->category_id = $parameters["category"] ;


        if (is_numeric($parameters["type"])
            && null !== Vocabulary::all()->where('type_id',VocabularyType::where("code","PDT-KIND")->first()->id)->where("id","=",$parameters["type"])->first())  {
            # code...
             $product->type_id = $parameters["type"] ;
        } else {
            # code...
            $type = new Vocabulary();
            $type->code = Str::random(5);
            $type->label = $parameters["type"];
            $type->type_id = VocabularyType::where("code","PDT-KIND")->first()->id;
            $type->parent = $product->category_id;
            $type->save();
            $product->type_id = $type->id;
        }

        if (is_numeric($parameters["label"])
            && null !== Vocabulary::all()->where('type_id',VocabularyType::where("code","PDT-LBL")->first()->id)->where("id","=",$parameters["label"])->first())  {
            # code...
             $product->label_id = $parameters["label"] ;
        } else {
            # code...
            $label = new Vocabulary();
            $label->code = Str::random(5);
            $label->label = $parameters["label"];
            $label->type_id = VocabularyType::where("code","PDT-LBL")->first()->id;
            $label->parent = $product->type_id;
            $label->save();
            $product->label_id = $label->id;
        }

        if (is_numeric($parameters["model"])
            && null !== Vocabulary::all()->where('type_id',VocabularyType::where("code","PDT-MDL")->first()->id)->where("id","=",$parameters["model"])->first()
            )

            {
            # code...
             $product->model_id = $parameters["model"] ;
        } else {
            # code...
            $model = new Vocabulary();
            $model->code = Str::random(5);
            $model->label = $parameters["model"];
            $model->type_id = VocabularyType::where("code","PDT-MDL")->first()->id;
            $model->parent = $product->label_id;
            $model->save();
            $product->model_id = $model->id;
        }

        $usr = User::find(Auth::user()->id);

        if ($usr->hasRole("manager")) {
            $product->partner_id = $usr->manager->partner_id;
        }
        else {
            $product->partner_id = $parameters["partner"];

        }
        $product->props = \json_encode([]);
        $product->state = isset($parameters['state']) ? 1 : 0 ;

        $product->save();

        return  redirect()->route('products.list');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
