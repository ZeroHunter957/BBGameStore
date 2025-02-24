<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameCategory;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::all();
        $cates = GameCategory::all();
        return view("game.index", compact("games"));
    }

    public function create()
    {
        $cates = GameCategory::all();
        return view("game.create", compact("cates"));
    }

    public function store(Request $request)
    {
        // Validate input fields
        $request->validate([
            "title" => "required",
            "price" => "required|numeric",
            "description" => "required",
            "developer" => "required",
            "platform" => "required|array", // Ensure platform is an array
            "release_date" => "required|date",
            "image" => "nullable|image|mimes:jpg,jpeg,png,gif|max:2048",
            "file" => "required|mimes:zip,rar,exe|max:10240"
        ]);

        try {
            $games = new Game();
            $games->title = $request->title;
            $games->cat_id = $request->cat_id;
            $games->price = $request->price;
            $games->description = $request->description;
            $games->developer = $request->developer;
            $games->platform = implode(", ", $request->platform); // Convert array to string
            $games->release_date = $request->release_date;

            // Handle Image Upload (if present)
            if ($request->hasFile("image")) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $request->image->move(public_path("gameimages"), $imageName);
                $games->image = "/gameimages/" . $imageName;
            }

            // Handle File Upload
            if ($request->hasFile("file")) {
                $fileName = time() . '_' . $request->file("file")->getClientOriginalName();
                $request->file->move(public_path("gamefiles"), $fileName);
                $games->file = "/gamefiles/" . $fileName;
            }

            $games->save();

            return redirect()->route("game.index")->with("message", "Game created successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with("message", "An error occurred: " . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $games = Game::findOrFail($id);
        $cates = GameCategory::all();
        return view("game.edit", compact("games", "cates"));
    }

    public function update(Request $request, Game $games)
    {
        $request->validate([
            "title" => "required",
            "price" => "required|numeric",
            "description" => "required",
            "developer" => "required",
            "platform" => "required|array",
            "release_date" => "required|date",
            "image" => "nullable|image|mimes:jpg,jpeg,png,gif|max:2048",
            "file" => "nullable|mimes:zip,rar,pdf,exe|max:10240"
        ]);

        try {
            $newImagePath = "";
            $newFilePath = "";

            // Handle Image Update
            if ($request->hasFile("image")) {
                $imageName = time() . '.' . $request->image->getClientOriginalExtension();
                $imagePath = "/gameimages/" . $imageName;
                $newImagePath = $imagePath;
                $request->image->move(public_path("gameimages"), $imageName);

                // Delete old image if exists
                $oldImagePath = public_path($games->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            } else {
                $imagePath = $games->image;
            }

            // Handle File Update
            if ($request->hasFile("file")) {
                $fileName = time() . '_' . $request->file("file")->getClientOriginalName();
                $filePath = "/gamefiles/" . $fileName;
                $newFilePath = $filePath;
                $request->file->move(public_path("gamefiles"), $fileName);

                // Delete old file if exists
                $oldFilePath = public_path($games->file);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            } else {
                $filePath = $games->file;
            }

            // Update Game Record
            $games->title = $request->title;
            $games->cat_id = $request->cat_id;
            $games->price = $request->price;
            $games->description = $request->description;
            $games->developer = $request->developer;
            $games->platform = implode(", ", $request->platform);
            $games->release_date = $request->release_date;
            $games->image = $imagePath;
            $games->file = $filePath;
            $games->save();

            return redirect()->route("game.index")->with("message", "Game updated successfully");
        } catch (\Throwable $th) {
            // If an error occurs, delete new files to avoid orphaned uploads
            if (!empty($newImagePath) && File::exists(public_path($newImagePath))) {
                File::delete(public_path($newImagePath));
            }
            if (!empty($newFilePath) && File::exists(public_path($newFilePath))) {
                File::delete(public_path($newFilePath));
            }

            return redirect()->back()->with("message", "error updating the game");
        }
    }

    public function setTodaysPick($id)
    {
        // Reset all games' todays_pick to 0
        Game::query()->update(['todays_pick' => 0]);

        // Set the selected game as today's pick
        $game = Game::findOrFail($id);
        $game->todays_pick = 1;
        $game->save();

        return redirect()->back()->with('message', "Today's Pick set to: {$game->title}");
    }
}
