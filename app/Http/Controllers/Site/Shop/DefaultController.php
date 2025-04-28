<?php

namespace App\Http\Controllers\Site\Shop;


use App\Http\Controllers\Site\Controller;

class DefaultController extends Controller
{
    public function index()
    {
        return view('site.shop.index');
    }

    public function category($category)
    {
        return view('site.shop.category');
    }

    public function product($category, $product)
    {
        return view('site.shop.product');
    }

    public function cart()
    {
        return view('site.shop.cart');
    }


}
