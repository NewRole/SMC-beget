<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function games()
    {
        $games = Game::latest()->get();
        return view('admin.games', compact('games'));
    }

    public function createGame()
    {
        return view('admin.games-create');
    }

    public function storeGame(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        Game::create($validated);

        return redirect()->route('admin.games')->with('success', 'Игра успешно добавлена');
    }

    public function editGame(Game $game)
    {
        return view('admin.games-edit', compact('game'));
    }

    public function updateGame(Request $request, Game $game)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|string',
            'location' => 'required|string|max:255',
        ]);

        $game->update($validated);

        return redirect()->route('admin.games')->with('success', 'Изменения сохранены');
    }

    public function destroyGame(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.games')->with('success', 'Игра удалена');
    }
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate([
            'userstatus' => 'required|in:Нет статуса,Резидент,Клиент-менеджер,Организатор,Член-совета,Банитет,Вице-президент,Президент',
        ]);

        $user->update(['userstatus' => $request->userstatus]);
        return back()->with('success', 'Статус пользователя обновлен!');
    }
}
