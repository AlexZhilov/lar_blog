<?php

namespace App\Filters\User;

use Illuminate\Database\Eloquent\Builder;
use Spatie\QueryBuilder\Filters\Filter;

class LastLoginFilter implements Filter
{

    public function __invoke(Builder $query, $value, string $property)
    {
        $period = strtolower($value);
        $field = 'last_activity';

        switch ($period) {
            case 'today':
                return $query->whereDate($field, today());
            case 'week':
                return $query->whereBetween($field, [now()->startOfWeek(), now()]);
            case 'month':
                return $query->whereBetween($field, [now()->startOfMonth(), now()]);
            case 'year':
                return $query->whereBetween($field, [now()->startOfYear(), now()]);
            case 'never':
                return $query->whereNull($field);
            default:
                return $query;
        }
    }
}