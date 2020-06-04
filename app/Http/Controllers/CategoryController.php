<?php

namespace App\Http\Controllers;

use App\Category;
use App\Article;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct() {

       $this->middleware('jwt.auth')->except('index', 'show');

    }

    public function index()
    {
        $categories = Category::all();
        return response()->json(['data'=> $categories], 200);
    }


    public function store(Request $request)
    {
         $rules = [
            'name' => 'required'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $category = Category::create($data);

        return response()->json(['data'=> $category], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json(['data' => $category], 202);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return response()->json(['data' -> $category], 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
