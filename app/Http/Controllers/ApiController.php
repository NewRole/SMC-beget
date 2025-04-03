<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    private $apiEndpoint;
    private $defaultParams;

    public function __construct()
    {
        $this->apiEndpoint = 'https://dev.rp.tkf.su/api/get_data.php?func=gr&PeriodType=Month&PeriodStart=2025-02-01&PeriodEnd=2025-02-28&NewbeeFilter=0';
        $this->defaultParams = [
            'count' => 10,
            'sort' => 'vr',
            'order' => 'desc'
        ];
    }

    public function getRatings()
    {
        try {
            return $this->handleApiRequest();
        } catch (\Exception $e) {
            Log::error('API Critical Error: '.$e->getMessage());
            return $this->errorResponse($e->getMessage());
        }
    }

    private function handleApiRequest()
    {
        $cacheKey = $this->generateCacheKey();

        return Cache::remember($cacheKey, 60, function () {
            $response = $this->makeApiRequest();
            return $this->processApiResponse($response);
        });
    }

    private function makeApiRequest()
    {
        $client = new Client([
            'verify' => storage_path('app/certs/cacert.pem'),
            'timeout' => 15,
            'headers' => [
                'User-Agent' => 'SmileMafiaClub/0.0',
                'Accept' => 'application/json'
            ]
        ]);

        try {
            $response = $client->get($this->apiEndpoint, [
                'query' => $this->defaultParams
            ]);

            $this->validateHttpResponse($response);
            return $response;

        } catch (\Exception $e) {
            Log::error('API Request Failed: '.$e->getMessage());
            throw new \Exception('Ошибка соединения с сервером рейтингов');
        }
    }

    private function validateHttpResponse($response)
    {
        if ($response->getStatusCode() !== 200) {
            throw new \Exception("Invalid HTTP status: ".$response->getStatusCode());
        }

        $contentType = $response->getHeaderLine('Content-Type');
        if (strpos($contentType, 'application/json') === false) {
            throw new \Exception("Invalid content type: ".$contentType);
        }
    }

    private function processApiResponse($response)
    {
        $body = $response->getBody()->getContents();
        $data = $this->parseResponseBody($body);

        if (!$this->isValidApiStructure($data)) {
            Log::error('Invalid API Structure', ['response' => $body]);
            throw new \Exception("Некорректный формат данных от сервера");
        }

        return $this->transformData($data['data']);
    }

    private function parseResponseBody($body)
    {
        try {
            return json_decode($body, true);
        } catch (\Exception $e) {
            Log::error('JSON Parse Error', ['body' => $body]);
            throw new \Exception("Ошибка обработки данных");
        }
    }

    private function isValidApiStructure($data)
    {
        $requiredKeys = ['result', 'caption', 'data'];
        foreach ($requiredKeys as $key) {
            if (!array_key_exists($key, $data)) {
                return false;
            }
        }
        return $data['result'] === 'ok' && is_array($data['data']);
    }


    private function transformData($apiData)
    {
        return [
            'caption' => 'Рейтинг игроков',
            'count' => count($apiData),
            'updateTime' => now()->format('d.m.Y H:i'),
            'players' => collect($apiData)->map(function ($player) {
                return [
                    // Основная информация
                    'UserID' => $player['UserID'] ?? 'N/A',
                    'Nick' => $player['Nick'] ?? 'Без имени',
                    'KI' => $player['KI'] ?? 0,
                    'VR' => $player['VR'] ?? 0,

                    // Победы
                    'Kpb' => $player['Kpb'] ?? 0,
                    'WinSheriff' => $player['WinSheriff'] ?? 0,
                    'WinRed' => $player['WinRed'] ?? 0,
                    'WinDon' => $player['WinDon'] ?? 0,
                    'WinBlack' => $player['WinBlack'] ?? 0,

                    // Поражения
                    'Kpr' => $player['Kpr'] ?? 0,
                    'LosingSheriff' => $player['LosingSheriff'] ?? 0,
                    'LosingRed' => $player['LosingRed'] ?? 0,
                    'LosingDon' => $player['LosingDon'] ?? 0,
                    'LosingBlack' => $player['LosingBlack'] ?? 0,

                    // Коэффициенты
                    'SrDB' => $player['SrDB'] ?? 0,
                    'SrB' => $player['SrB'] ?? 0,
                    'OMI' => $player['OMI'] ?? 0,
                    'KMI' => $player['KMI'] ?? 0,
                    'MLH' => $player['MLH'] ?? 0,
                    'KKI' => $player['KKI'] ?? 0,
                    'SAF' => $player['SAF'] ?? 0,
                    'TKM' => $player['TKM'] ?? 0,

                    // Штрафы
                    'SH' => $player['SH'] ?? 0,
                    'K' => $player['K'] ?? 0,
                    'U' => $player['U'] ?? 0,
                    'F' => $player['F'] ?? 0,
                    'SmDB' => $player['SmDB'] ?? 0,
                    'DB_SH' => $player['DB_SH'] ?? 0,
                    'KLH' => $player['KLH'] ?? 0,

                    // Доп. баллы
                    'EPmr' => $player['EPmr'] ?? 0,
                    'EPmf' => $player['EPmf'] ?? 0,
                    'EPsh' => $player['EPsh'] ?? 0,
                    'EPd' => $player['EPd'] ?? 0,

                    // Лучшие ходы
                    'bm_2black' => $player['bm_2black'] ?? 0,
                    'bm_3black' => $player['bm_3black'] ?? 0,
                    'bm_3red' => $player['bm_3red'] ?? 0,

                    // Слоты
                    'p1' => $player['p1'] ?? 0,
                    'p4' => $player['p4'] ?? 0,
                    'fs' => $player['fs'] ?? 0
                ];
            })
        ];
    }


    private function formatPercentage($value)
    {
        return is_numeric($value) ? round($value, 2).'%' : '0%';
    }

    private function generateCacheKey()
    {
        return 'ratings_'.md5(serialize($this->defaultParams));
    }

    private function errorResponse($message)
    {
        return view('ratings', [
            'caption' => 'Ошибка',
            'players' => [],
            'updateTime' => now()->format('d.m.Y H:i'),
            'count' => 0,
            'error' => $message
        ]);
    }
}
