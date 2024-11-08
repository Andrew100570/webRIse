<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Requests\GetNumberRequest;
use App\Http\Requests\GetSmsRequest;
use App\Http\Requests\CancelNumberRequest;
use App\Http\Requests\GetStatusRequest;
use Illuminate\Http\JsonResponse;

class SmsProxyController extends Controller
{
    // Выданные токен для тестирования
    private $tokens = [
        'getNumber' => 'qergt34gqewf3245y6364ywergwergwergw234123r123r',
        'getSms' => 'qergt34gqewf3245y6364ywergwergwergw234123r123r',
        'cancelNumber' => 'qergt34gqewf3245y6364ywergwergwergw234123r123r',
        'getStatus' => 'qergt34gqewf3245y6364ywergwergwergw234123r123r',
    ];

    private $apiBaseUrl = 'https://postback-sms.com/api/';

    /**
     * Получить номер телефона
     *
     * @param GetNumberRequest $request
     * @return JsonResponse
     */
    public function getNumber(GetNumberRequest $request): JsonResponse
    {
        $params = [
            'action' => 'getNumber',
            'country' => $request->input('country'),
            'service' => $request->input('service'),
            'token' => $this->tokens['getNumber'],
        ];

        // Если rent_time передан, добавляем его в параметры

        if ($request->filled('rent_time')) {
            $params['rent_time'] = $request->input('rent_time');
        }

        $response = Http::get($this->apiBaseUrl, $params);

        $responseData = $response->json();

        if (isset($responseData['code']) && $responseData['code'] === 'error') {
            return response()->json([
                'code' => 'error',
                'message' => $responseData['message'] ?? 'An error occurred'
            ], 400);
        }

        return response()->json($responseData);
    }

    /**
     * Получить SMS для номера
     *
     * @param GetSmsRequest $request
     * @return JsonResponse
     */
    public function getSms(GetSmsRequest $request): JsonResponse
    {
        $response = Http::get($this->apiBaseUrl, [
            'action' => 'getSms',
            'token' => $this->tokens['getSms'],
            'activation' => $request->input('activation'),
        ]);

        $responseData = $response->json();

        if (isset($responseData['code']) && $responseData['code'] === 'error') {
            return response()->json([
                'code' => 'error',
                'message' => $responseData['message'] ?? 'An error occurred'
            ], 400);
        }

        return response()->json($responseData);
    }

    /**
     * Отменить номер
     *
     * @param CancelNumberRequest $request
     * @return JsonResponse
     */
    public function cancelNumber(CancelNumberRequest $request): JsonResponse
    {
        $response = Http::get($this->apiBaseUrl, [
            'action' => 'cancelNumber',
            'token' => $this->tokens['cancelNumber'],
            'activation' => $request->input('activation'),
        ]);

        $responseData = $response->json();

        if (isset($responseData['code']) && $responseData['code'] === 'error') {
            return response()->json([
                'code' => 'error',
                'message' => $responseData['message'] ?? 'An error occurred'
            ], 400);
        }

        return response()->json($responseData);
    }

    /**
     * Получить статус активации
     *
     * @param GetStatusRequest $request
     * @return JsonResponse
     */
    public function getStatus(GetStatusRequest $request): JsonResponse
    {
        $response = Http::get($this->apiBaseUrl, [
            'action' => 'getStatus',
            'token' => $this->tokens['getStatus'],
            'activation' => $request->input('activation'),
        ]);

        $responseData = $response->json();


        if (isset($responseData['code']) && $responseData['code'] === 'error') {
            return response()->json([
                'code' => 'error',
                'message' => $responseData['message'] ?? 'An error occurred'
            ], 400);
        }

        return response()->json($responseData);
    }

}
