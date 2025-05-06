<?php

namespace App\Http\View\Composers\Blog;

use App\Repositories\Blog\CategoryRepository;
use App\Repositories\Blog\TagRepository;
use Cache;
use Illuminate\View\View;

class BlogComposer
{
    private CategoryRepository $categories;
    private TagRepository $tags;


    public function __construct(
        CategoryRepository $categories,
        TagRepository $tags
    )
    {
        $this->categories = $categories;
        $this->tags = $tags;
    }

    public function compose(View $view): void
    {
        static $categories = null;
        static $tags = null;

        if ($categories === null) {
            $categories = Cache::remember('blog_categories', now()->addMinutes(0), function () {
                return $this->categories->getAll();
            });
        }

        if ($tags === null) {
            $tags = Cache::remember('blog_tags', now()->addMinutes(0), function () {
                return $this->tags->getTagCloud();
            });
        }

        $view->with('categories', $categories);
        $view->with('tags', $tags);
    }

}