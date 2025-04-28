<?php

namespace App\Http\Controllers\Site;

class DefaultController extends Controller
{
    public function index()
    {
        return view('site.index');
    }
}
