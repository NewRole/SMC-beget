<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function games()
    {
        $games = Game::all();
        return view('admin.games', compact('games'));
    }

    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function updateUserStatus(Request $request, User $user)
    {
        $request->validate([
            'userstatus' => 'required|in:Нет статуса,Резидент,Клубная карта,Клиент-менеджер,Организатор,Член совета,Банитет,Вице-президент,Президент',
        ]);

        $user->update(['userstatus' => $request->userstatus]);
        return back()->with('success', 'Статус пользователя обновлен!');
    }
}
