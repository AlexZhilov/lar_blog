<?php

namespace App\Http\Controllers\Admin;

class MainController extends BaseController
{
    public function index()
    {
        return view('admin.index');
    }
}
