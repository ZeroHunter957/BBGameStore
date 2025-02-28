<?php

namespace App\Http\Controllers;

use App\Models\GameCategory;
use Illuminate\Http\Request;

class GameCategoryController extends Controller
{
    public function index(){
        $gamecategories = GameCategory::all();
        return view("gamecategory.index", compact("gamecategories"));
    }

    public function create(){
        return view("gamecategory.create");
    }

    public function store(Request $request){
        GameCategory::create($request->all());
        return redirect()->route("gamecategory.index")->with("message","Category created");
    }

    public function delete($id){
        $cate = GameCategory::find($id);
        $cate->delete();
        return redirect()->route("gamecategory.index")->with("message","Category deleted");
    }
}