<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckProxyToken
{


    // Приватный массив токенов
    private $tokens = [
        'getNumber' => 'qergt34gqewf3245y6364ywergwergwergw234123r123r',
        'getSms' => 'qergt34gqewf3245y6364ywergwergwergw234123r123r',
        'cancelNumber' => 'qergt34gqewf3245y6364ywergwergwergw234123r123r',
        'getStatus' => 'qergt34gqewf3245y6364ywergwergwergw234123r123r',
    ];


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {


        $action = $request->input('action');

        // Проверяем, есть ли action в запросе
        if (!$action) {
            return response()->json([
                'code' => 'error',
                'message' => 'Action parameter is required'
            ], 400);
        }

        if (array_key_exists($action, $this->tokens)) {

            $token = $request->bearerToken();

            // Проверяем, совпадает ли переданный токен с токеном для данного ключа action
            if ($token !== $this->tokens[$action]) {
                return response()->json([
                    'code' => 'error',
                    'message' => 'Invalid API token for this action'
                ], 401);
            }
        } else {
            return response()->json([
                'code' => 'error',
                'message' => 'Invalid action specified'
            ], 400);
        }


        return $next($request);

    }
}
