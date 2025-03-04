<?php

namespace App\Http\Controllers;

use App\Models\GameCategory;
use Illuminate\Http\Request;

class GameCategoryController extends Controller
{
    public function index()
    {
        $gamecategories = GameCategory::all();
        return view("gamecategory.index", compact("gamecategories"));
    }

    public function create()
    {
        return view("gamecategory.create");
    }

    public function store(Request $request)
    {
        GameCategory::create($request->all());
        return redirect()->route("gamecategory.index")->with("message", "Category created");
    }

    public function edit($id)
    {
        $gamecategory = GameCategory::findOrFail($id);
        return view('gamecategory.edit', compact('gamecategory'));
    }
    public function delete($id)
    {
        $cate = GameCategory::find($id);
        $cate->delete();
        return redirect()->route("gamecategory.index")->with("message", "Category deleted");
    }

    public function update(Request $request, $id)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $gamecategory = GameCategory::findOrFail($id);
            $gamecategory->name = $request->name;
            $gamecategory->save();

            return redirect()->route('gamecategory.index')->with('message', 'Game category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $gamecategory = GameCategory::findOrFail($id);
            $gamecategory->delete();

            return redirect()->route('gamecategory.index')->with('message', 'Game category deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('message', 'An error occurred: ' . $e->getMessage());
        }
    }
}
