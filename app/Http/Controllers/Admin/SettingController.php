<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        return Setting::pluck('value', 'key')->toArray();
    }

    public function update()
    {
        $settings = request()->all();

        foreach ($settings as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return response()->json(['success' => true]);
    }
}
