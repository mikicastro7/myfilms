<?php

namespace App\Http\Controllers\AdminControllers;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class AdminCategoriesController extends Controller
{
    public function Categories(){
        return view('admin.categoriesAdmin');
    }
    public function getCategories(){
        return Datatables::of(Category::query())->make(true);
    }
    public function addCategory(Request $request){
        $category = new Category;
        $categoryName = $request->input('name');
        $categoryDescription = $request->input('description');

        if($categoryName == null){
            return response()->json(['error' => "Name field it's empty"], 500);
        }
        if($categoryDescription == null){
            return response()->json(['error' => "description field it's empty"], 500);
        }

        $category->name = $categoryName;
        $category->description = $categoryDescription;
        $category->save();

        $notification = array(
            'message' => 'Category Added succesfully!',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }

    public function deleteCategory(Request $request){
        $category = Category::find($request->category_id);
        $category->delete();
        $notification = array(
            'message' => 'Category deleted',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);
    }

    public function editCategory(Request $request){
        $category = Category::find($request->category_id);
        $categoryName = $request->input('name');
        $categoryDescription = $request->input('description');

        if($categoryName == null){
            return response()->json(['error' => "Name field it's empty"], 500);
        }
        if($categoryDescription == null){
            return response()->json(['error' => "description field it's empty"], 500);
        }

        $category->name = $categoryName;
        $category->description = $categoryDescription;
        $category->save();

        $notification = array(
            'message' => 'Category Edited succesfully!',
            'alert-type' => 'success'
        );

        return response()->json([
            'notification' => $notification,
        ]);

    }

}
