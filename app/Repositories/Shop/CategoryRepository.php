<?php

namespace App\Repositories\Shop;

use App\Models\Shop\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository
{

    protected function getModel(): string
    {
        return Category::class;
    }
}