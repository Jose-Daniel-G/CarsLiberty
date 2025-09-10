<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
   
    public function index()
    {  $categories = Category::all();
        return view('news.categories.index',compact('categories'));
    }

    // public function create(){}

    public function store(Request $request)
    {
        $request->validate(['name'=> 'required|max:255']);
        $category = new Category();
        $category->name=$request->name;
        $category->slug=$request->name;
        $category->save();
        return redirect()->route('categories')->with('success', 'Category Created succesfully');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('news.categories.show', ['category' => $category]);
    }
  
    public function edit($id){ }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;

        $category->save();
        return redirect()->route('categories')->with('success','Tasks Update');
    }

   
    public function destroy($id)
    {
        $categories = Category::find($id);
        $categories->breakingNews()->each(function($breakingNews){
            $breakingNews->delete();
        });
        $categories->delete();
        
        return redirect()->route('categories')->with('success', 'Task deleted succesfully');
    }
}
