<?php

namespace App\Http\Controllers;

use App\Models\AccessoryCategory;
use Illuminate\Http\Request;

class AccessoryCategoryController extends Controller
{
    public function index(){
        $accessorycategories = AccessoryCategory::all();
        return view("accessorycategory.index", compact("accessorycategories"));
    }

    public function create(){
        return view("accessorycategory.create");
    }

    public function store(Request $request){
        AccessoryCategory::create($request->all());
        return redirect()->route("accessorycategory.index")->with("message","Category created");
    }

    public function delete($id){
        $cate = AccessoryCategory::find($id);
        $cate->delete();
        return redirect()->route("accessorycategory.index")->with("message","Category deleted");
    }
}