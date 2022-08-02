<?php

namespace App\Http\Controllers\Site;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }
}
