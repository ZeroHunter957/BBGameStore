<?php

namespace App\Http\Controllers;

use App\Mail\DownloadCodeMail;
use App\Models\Account;
use App\Models\Game;
use App\Models\GameDownloadCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Str;

class DownloadCodeController extends Controller
{
    public function sendDownloadCode($gameId)
    {
        $accountId = session('accountLogin');
        $game = Game::findOrFail($gameId);
        $account = Account::find($accountId);

        $download = GameDownloadCode::where('account_id', $accountId)
            ->where('game_id', $game->id)
            ->first();

        // Nếu đã tồn tại, kiểm tra thời gian 2 tuần
        if ($download && $download->last_download_at && Carbon::parse($download->last_download_at)->diffInWeeks(now()) < 2) {
            return back()->with('error', 'You can only get the reload code after 2 weeks.');
        }

        // Tạo mã mới hoặc cập nhật mã cũ
        $code = Str::random(10);
        GameDownloadCode::updateOrCreate(
            ['account_id' => $accountId, 'game_id' => $game->id],
            ['download_code' => $code, 'last_download_at' => now()]
        );

        // Gửi email
        Mail::to($account->email)->send(new DownloadCodeMail($code, $game->title));

        return back()->with('message', 'The game download code has been sent to your email.');
    }

    public function verifyDownloadCode(Request $request, $gameId)
{
    $accountId = session('accountLogin');
    $download = GameDownloadCode::where('account_id', $accountId)
        ->where('game_id', $gameId)
        ->first();

    $gameFile = Game::find($gameId);

    if (!$download || !$download->download_code || $download->download_code !== $request->download_code) {
        return back()->with('error', 'The game download code is invalid or has already been used.');
    }

    $gameFilePath = public_path($gameFile->file);

    if (!file_exists($gameFilePath)) {
        return back()->with('error', 'Game file does not exist.');
    }

    // set download_code == nul
    $download->update(['download_code' => null]);

    //session->flash()
    session()->flash('download_url', asset($gameFile->file));

    return back()->with('success', 'You have successfully downloaded the game!');
}

}
