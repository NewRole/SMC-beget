<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Carbon;

class GameController extends Controller
{
    public function index()
    {
        $now = Carbon::now();

        $games = [
            'today' => Game::whereDate('date', $now->toDateString())
                ->whereTime('time', '>=', $now->toTimeString())
                ->orderBy('date')
                ->orderBy('time')
                ->get(),

            'upcoming' => Game::where(function($query) use ($now) {
                $query->whereDate('date', '>', $now->toDateString())
                    ->orWhere(function($q) use ($now) {
                        $q->whereDate('date', $now->toDateString())
                            ->whereTime('time', '>', $now->toTimeString());
                    });
            })
                ->orderBy('date')
                ->orderBy('time')
                ->get(),

            'past' => Game::where(function($query) use ($now) {
                $query->whereDate('date', '<', $now->toDateString())
                    ->orWhere(function($q) use ($now) {
                        $q->whereDate('date', $now->toDateString())
                            ->whereTime('time', '<', $now->toTimeString());
                    });
            })
                ->orderBy('date', 'desc')
                ->orderBy('time', 'desc')
                ->get()
        ];

        return view('games', compact('games'));
    }
}
