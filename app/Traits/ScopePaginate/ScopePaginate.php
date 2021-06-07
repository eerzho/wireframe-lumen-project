<?php

namespace App\Traits\ScopePaginate;

use Illuminate\Database\Eloquent\Builder;

/**
 * Trait ScopePaginate
 * @package PfdoPackages\LaravelComponents\Traits\ScopeTraits
 */
trait ScopePaginate
{
    /**
     * @param Builder $query
     * @param int     $page
     * @param int     $perPage
     *
     * @return array
     */
    public function scopeCustomPaginate(Builder $query, int $perPage = 10)
    {
        $page = (int) request()->get('page', 1);

        return [
            'total' => $query->count(),
            'data'  => $query->skip($perPage * ($page - 1))->take($perPage)->get(),
        ];
    }
}
