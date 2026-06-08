<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categoryList = Category::whereNull('parent_id')->with('children')->get();

        $category= Category::with('children')->paginate(5);

        return view('admin.category', compact('categoryList', 'category'));
    }

    public function addCategory(Request $request)
    {
        try{
            Category::create($request->all());

            return response()->json([
                'msg'=> "Category created successfully.",
                'success'=>true
            ]);
        }catch(\Exception $e){
            return abort(403, $e->getMessage());
        }

       
    }

    public function updateCategory(Request $request)
    {
        try{

        $find = Category::find($request->id);

        if(!$find){
                  return response()->json([
                    'msg'=> "Category not found.",
                    'success'=> false
            ]);
        }

        $find->update([
            'name'=>$request->name,
            'parent_id'=> $request->parent_id
        ]);
        

         return response()->json([
                'msg'=> "Category updated successfully.",
                'success'=>true
            ]);

        }catch(\Exception $e){
           return response()->json([
                    'msg'=> $e->getMessage(),
                    'success'=> false
            ]);
        }
    }

    public function deleteCategory($id)
    {
        try{
                 $find = Category::find($id);

                    if(!$find){
                        return back()->with('msg', 'Record not found');
                    }

                    $find->delete();

                    return back()->with('msg', 'Record deleted succesfully.');

        }catch(\Exception $e){
                return abort(403, $e->getMessage());
        }
       

    }
}
