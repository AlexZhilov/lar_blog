<?php

namespace App\Http\Controllers\Site;

class DefaultController extends BaseController
{
    public function index()
    {
        flash()->success('Вы успешно зарегистрировались! Пожалуйста, проверьте свою почту.');
        return view('site.index');
    }
}
