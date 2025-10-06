<?php

namespace App\Http\Controllers;


class LangController extends Controller
{
    public function switchLanguage($langIso)
    {
        $langIso = substr(strtolower($langIso), 0,2);
        app()->setLocale($langIso);
        session()->put('langIso', $langIso);
        return to_route('index');
    }
}
