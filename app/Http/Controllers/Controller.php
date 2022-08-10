<?php

namespace App\Http\Controllers;

use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Set meta-tags on pages
     * @var MetaInterface
     */
    protected $meta;

    /**
     * Create a new controller instance.
     *
     * @param MetaInterface $meta
     */
    public function __construct(MetaInterface $meta)
    {
//        $this->middleware('auth');
        $this->meta = $meta;
    }

}
