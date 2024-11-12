<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ButtonController extends Controller
{
    /**
     * Отображение страницы с кнопками.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('buttons');
    }
}
