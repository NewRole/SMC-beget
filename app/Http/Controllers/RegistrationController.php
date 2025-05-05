<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game; // Добавляем импорт модели
use App\Models\Registration; // Добавляем импорт модели

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate(['game_id' => 'required|exists:games,id']);
            $game = Game::withCount('registrations')->findOrFail($request->game_id);

            // Изменить проверку
            if ($game->registrations_count >= $game->max_players) {
                return response()->json([
                    'error' => 'Все места заняты'
                ], 422);
            }
            // Проверяем, что игра не началась
            $gameDateTime = $game->date->setTimeFromTimeString($game->time);
            if ($gameDateTime <= now()) {
                return response()->json([
                    'error' => 'Запись на начавшиеся игры невозможна'
                ], 422);
            }

            // Проверка существующей записи
            if (auth()->user()->registrations()
                ->where('game_id', $request->game_id)
                ->exists()) {
                return response()->json([
                    'error' => 'Вы уже записаны на эту игру'
                ], 422);
            }

            // Создание записи
            auth()->user()->registrations()->create([
                'game_id' => $request->game_id,
                'status' => 'active'
            ]);

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            \Log::error('Ошибка записи: '.$e->getMessage());
            return response()->json([
                'error' => 'Произошла ошибка при записи'
            ], 500);
        }
    }


    public function index()
    {
        $registrations = auth()->user()
            ->registrations()
            ->with('game')
            ->latest()
            ->get();

        return view('registrations.index', compact('registrations'));
    }
    public function destroy(Registration $registration)
    {
        // Проверка что пользователь удаляет свою запись
        if ($registration->user_id !== auth()->id()) {
            abort(403);
        }

        $registration->delete();

        return back()->with('success', 'Запись успешно отменена');
    }
    // app/Http/Controllers/Auth/RegisterController.php

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-zA-Zа-яА-ЯёЁ0-9_\-\s]+$/u' // Только буквы, цифры, пробелы, дефисы и подчеркивания
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^[^<>]+$/' // Запрет символов < и >
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^[^<>]+$/'
            ],
        ], [
            'name.regex' => 'Имя содержит запрещенные символы',
            'email.regex' => 'Email содержит запрещенные символы',
            'password.regex' => 'Пароль содержит запрещенные символы'
        ]);
    }
}
