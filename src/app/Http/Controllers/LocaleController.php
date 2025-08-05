<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    public function index(Request $request)
    {
        $locale = request()->route('locale');

        if (count(config('app._supported_locales')) <= 1) {
            abort(403, "App only supports one(1) locale");
        }

        if (! in_array($locale, config('app._supported_locales'))) {
            abort(403, "Locale is not supported");
        }

        app()->setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();
    }
}
