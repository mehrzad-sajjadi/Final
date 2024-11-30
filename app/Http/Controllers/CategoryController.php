<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoryController extends Controller{


public function index(){
    $categories = Category::all()->map(function($record){
        $array = [];
        $array["id"]        = ["key"=>"id","type"=>"text","data"=>$record->id ] ;
        $array["name"]      = ["key"=>"name","data"=>$record->name,"type"=>"text"] ;
        $array["button"]    = [ "type"=>"button",
                                "items"=>   [
                                    ["data"=>route("category.index")     ,  "method"=>"get"      ,"value"=>"نمایش"    , "type"=>"show"        ]
                                ],
                            ];
        return $array;
    });
    $header = ["id", "نام دسته بندی", "عملیات"];
    return Inertia::render("Category/index",compact("categories","header"));
}


public function show(Category $category)
{
    $posts=Post::where("category_id",$category->id)->get()->map(function($record){
        $array = [];
        $array["id"]        = ["key"=>"id","type"=>"text","data"=>$record->id ] ;
        $array["name"]      = ["key"=>"name","data"=>$record->name,"type"=>"text"] ;            
        return $array;
    });
    $header = ["id","name"];
    return Inertia::render("Category/show",compact("posts","category","header"));

}



public function create()
{
    return Inertia::render('Category/create');
}


public function store(categoryRequest $categoryRequest)
{
    $category=new Category();
    $category->name = $categoryRequest->name;
    $category->user_id = $categoryRequest->user_id;

    $category->save();
    return redirect()->route("category.index")->with("message","دسته بندی با موفقیت ایجاد شد");
}





/**
 * Show the form for editing the specified resource.
 */
public function edit(Category $category)
{

    return Inertia::render("Category/edit",compact('category'));
}

/**
 * Update the specified resource in storage.
 */

public function update(categoryRequest $categoryStoreRequest,Category $category)
{

    $category->name=$categoryStoreRequest->name;
    $check = $category->where("name",$category->name)->first();
    if($check){
        return redirect()->route("category.edit",$category->id);
    }else{
        $category->save();
        return redirect()->route("category.index")->with("message","دسته بندی مورد نظر ویرایش شد");    
    }
}

/**
 * Remove the specified resource from storage.
 */
public function destroy(Category $category)
{
    $category->delete();
    return redirect()->route("category.index")->with("message","دسته بندی مورد نظر حذف شد");;
}

}
