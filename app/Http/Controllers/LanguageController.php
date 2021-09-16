<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function lang($locale)
    {
        if (in_array($locale, ['en', 'np']))
        {
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }
}
