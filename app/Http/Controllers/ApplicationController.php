<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __invoke()
    {
        return view('admin.layouts.app');
    }
}
