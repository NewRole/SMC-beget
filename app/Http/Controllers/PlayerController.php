<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Carbon\Carbon;

class PlayerController extends Controller
{
    public function index()
    {
        // Определяем хронологический порядок месяцев
        $monthOrder = [
            'Ноябрь 24',
            'Декабрь 24',
            'Январь 25',
            'Февраль 25',
            'Март 2025',
            'Апрель 2025',
            'Май 2025'
        ];

        $tables = [];

        foreach ($monthOrder as $month) {
            $players = Player::where('table_name', $month)
                ->orderBy('place', 'asc')
                ->orderBy('tkm', 'desc')
                ->get()
                ->map(function ($player) {
                    return $player->toArray();
                })
                ->toArray();

            if (count($players) > 0) {
                $tables[$month] = $players;
            }
        }

        $lastUpdate = Player::max('updated_at');
        $lastUpdate = $lastUpdate ? Carbon::parse($lastUpdate) : null;

        return view('ratings', compact('tables', 'lastUpdate'));
    }

}
