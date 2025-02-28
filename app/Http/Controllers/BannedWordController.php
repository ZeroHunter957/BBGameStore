<?php
namespace App\Http\Controllers;

use App\Models\BannedWord;
use Illuminate\Http\Request;

class BannedWordController extends Controller
{
    public function index()
    {
        $bannedWords = BannedWord::all();
        return view('words.index', compact('bannedWords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'word' => 'required|string|max:255|unique:banned_words,word',
        ]);

        BannedWord::create($request->only('word'));

        return redirect()->route('words.index')->with('success', 'Banned word added successfully');
    }

    public function destroy($id)
    {
        BannedWord::destroy($id);
        return redirect()->route('words.index')->with('success', 'Banned word deleted successfully');
    }
}
