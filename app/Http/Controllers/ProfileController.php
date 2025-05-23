<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Показываем страницу редактирования профиля
    public function edit()
    {
        return view('profile.edit');
    }

    // Обновляем данные профиля
    public function update(Request $request)
    {
        $user = Auth::user();

        // Валидация данных
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Обновляем профиль
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Profile updated successfully!');
    }
}
