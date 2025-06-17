<?php

namespace App\Imports;

use App\Models\Player;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PlayersImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    private $rowCount = 0;
    private $tableName;
    private $existingPlayers = [];


    public function __construct(string $tableName)
    {
        $this->tableName = $tableName ?: 'Без названия';

    }

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        // Пропускаем пустые строки
        if (empty($row[1]) || !is_numeric($row[0])) {
            return null;
        }

        // Обрабатываем только числовые значения для места
        if (!is_numeric($row[0])) {
            return null;
        }

        $row = array_pad($row, 7, null);

        $name = trim($row[1]);
        $playerKey = $this->tableName . '_' . md5($name);

        // Проверяем, не обрабатывали ли мы уже этого игрока
        if (isset($this->existingPlayers[$playerKey])) {
            return null;
        }

        $this->existingPlayers[$playerKey] = true;
        $this->rowCount++;

        return new Player([

            'table_name' => $this->tableName,
            'place' => (int)$this->parseInt($row[0]),
            'name' => trim($row[1]),
            'tkm' => $this->parseFloat($row[2]),
            'games_played' => $this->parseInt($row[3]),
            'wins' => $this->parseInt($row[4]),
            'losses' => $this->parseInt($row[5]),
            'win_rate' => $this->parseWinRate($row[6]),
        ]);
    }

    // Исправленная опечатка: было "pprotected"
    protected function parseFloat($value): float
    {
        if (is_string($value)) {
            $value = str_replace(',', '.', $value);
            $value = preg_replace('/[^\d\.]/', '', $value);
        }

        return is_numeric($value) ? (float)$value : 0.0;
    }

    protected function parseInt($value): int
    {
        if (is_string($value)) {
            $value = preg_replace('/[^\d]/', '', $value);
        }

        return is_numeric($value) ? (int)$value : 0;
    }

    protected function parseWinRate($value): float
    {
        if (is_string($value) && str_contains($value, '%')) {
            $value = str_replace('%', '', $value);
            $value = str_replace(',', '.', $value);
            return (float)trim($value);
        }

        return $this->parseFloat($value);
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}
