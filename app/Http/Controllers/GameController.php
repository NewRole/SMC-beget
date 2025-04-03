<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Carbon;

class GameController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');

        $games = collect([
            'today' => Game::whereDate('date', $today)->get(),
            'upcoming' => Game::where('date', '>', $today)->get(),
            'past' => Game::where('date', '<', $today)->get()
        ]);

        return view('games', compact('games'));
    }
}
