<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;

class DataController extends Controller
{
    /**
     * Получение данных с использованием Eloquent.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        // Получаем все данные из таблицы link с отношениями data и info
        $results = Link::with(['data', 'info'])->get();
        //Если необходимо снижение объема данных ,
        //то укажем конкретные поля select - $results = Link::with(['data:id,value,date', 'info:id,name'])->get();

        return response()->json($results);
    }
}
