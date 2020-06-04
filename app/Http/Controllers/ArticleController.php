<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Request\ArticleRequest;


class ArticleController extends Controller
{
    public function __construct() {

       $this->middleware('jwt.auth')->except('index', 'show');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return response()->json(['data' => $articles],200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {

        $data = $request->all();
        $category = Category::find($data['category_id']);
  
        if($category){
            $article = Article::create($data);
        }else{// category could not found = null
            return response()->json(['data'=> $category], 404);
        }
        return response()->json(['data'=> $article], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    //find list of articles by their category
    public function show($id)
    {
        $category = Category::find($id);

        if($category)
        $articles = $category->articles;
        else
        $articles = null;

        return response()->json(['data' => $articles], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        return response()->json(['data' => $articles], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
}
