<?php

namespace App\Http\Controllers\Site;

use Butschster\Head\Contracts\MetaTags\MetaInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

abstract class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Set meta-tags on pages
     */
    protected ?MetaInterface $meta = null;

    public function __construct(MetaInterface $meta = null)
    {
//        $this->middleware('auth');
        $this->meta = $meta;
    }
}
