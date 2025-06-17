<?php

namespace App\Console\Commands;

use App\Models\Player;
use Illuminate\Console\Command;
use App\Imports\PlayersImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportPlayersData extends Command
{
    protected $signature = 'import:players';
    protected $description = 'Automatically import players data from Excel file';

    public function handle()
    {
        ini_set('memory_limit', '512M');

        $filePath = 'excel/Рейтинг Смайла.xlsx';

        if (!Storage::exists($filePath)) {
            $this->error("Excel file not found: {$filePath}");
            return;
        }

        try {
            $fullPath = Storage::path($filePath);

            // Очищаем старые данные
            Player::truncate();

            // Получаем имена листов
            $reader = IOFactory::createReaderForFile($fullPath);
            $sheetNames = $reader->listWorksheetNames($fullPath);

            $this->info("Found sheets: " . implode(', ', $sheetNames));

            foreach ($sheetNames as $index => $sheetName) {
                try {
                    $effectiveSheetName = $sheetName ?: 'Таблица ' . ($index + 1);
                    $this->info("Importing sheet: {$effectiveSheetName}");

                    // Импортируем только текущий лист
                    $import = new PlayersImport($effectiveSheetName);
                    Excel::import($import, $fullPath, null, \Maatwebsite\Excel\Excel::XLSX, [
                        'sheet' => $sheetName
                    ]);

                    $this->info("Imported {$import->getRowCount()} players from sheet: {$effectiveSheetName}");
                } catch (\Exception $e) {
                    $this->error("Error importing sheet {$sheetName}: ".$e->getMessage());
                }
            }

            $this->info('Successfully imported '.Player::count().' total players');
        } catch (\Exception $e) {
            $this->error('Import failed: '.$e->getMessage());
        }
    }
}
