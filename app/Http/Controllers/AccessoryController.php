<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use App\Models\AccessoryCategory;
use File;
use Illuminate\Http\Request;

class AccessoryController extends Controller
{
    public function index(){
        $accessories = Accessory::all();
        $cates = AccessoryCategory::all();
        return view("accessory.index",compact("accessories"));
    }

    public function create(){
        $cates = AccessoryCategory::all();
        return view("accessory.create",compact("cates"));
    }

    public function store(Request $request)
{
    // Validate input fields
    $request->validate([
        "name" => "required",
        "price" => "required|numeric",
        "description" => "required",
        "image" => "nullable|image|mimes:jpg,jpeg,png,gif|max:2048",
    ]);

    try {
        $accessories = new Accessory();
        $accessories->name = $request->name;
        $accessories->cat_id = $request->cat_id;
        $accessories->price = $request->price;
        $accessories->description = $request->description;

        // Handle Image Upload (if present)
        if ($request->hasFile("image")) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path("accessoryimages"), $imageName);
            $accessories->image = "/accessoryimages/" . $imageName;
        }

        $accessories->save();

        return redirect()->route("accessory.index")->with("message", "Accessory created successfully!");
    } catch (\Exception $e) {
        return redirect()->back()->with("message", "An error occurred: " . $e->getMessage());
    }
}

    public function edit($id)
    {
        $accessories = Accessory::findOrFail($id);
        $cates = AccessoryCategory::all();
        return view("accessory.edit", compact("accessories", "cates"));
    }

    public function update(Request $request, Accessory $accessories)
    {
        $request->validate([
            "name" => "required",
            "price" => "required|numeric",
            "description" => "required",
            "image" => "nullable|image|mimes:jpg,jpeg,png,gif|max:2048",
        ]);

        try {
            $newImagePath = "";

            // Handle Image Update
            if ($request->hasFile("image")) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $imagePath = "/accessoryimages/" . $imageName;
                $newImagePath = $imagePath;
                $request->image->move(public_path("accessoryimages"), $imageName);

                // Delete old image if exists
                $oldImagePath = public_path($accessories->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            } else {
                $imagePath = $accessories->image;
            }

            // Update Accessory Record
            $accessories->name = $request->name;
            $accessories->cat_id = $request->cat_id;
            $accessories->price = $request->price;
            $accessories->description = $request->description;
            $accessories->image = $imagePath;
            $accessories->save();

            return redirect()->route("accessory.index")->with("message", "Accessory updated successfully");
        } catch (\Throwable $th) {
            // If an error occurs, delete new files to avoid orphaned uploads
            if (!empty($newImagePath) && File::exists(public_path($newImagePath))) {
                File::delete(public_path($newImagePath));
            }

            return redirect()->back()->with("message", "error updating the accessory");
        }
    }

    // public function delete($id){
    //     $accessories = Accessory::find($id);
    //     $accessories->delete();
    //     return redirect()->route("accessory.index")->with("message","Accessory deleted");
    // }
}