<?php

namespace App\Traits;


trait Filterable
{
    public function scopeFilters($query, $request)
    {
        // Normal Filter without relations
        foreach (self::$filters as $allowedFilter) {
            if ($request->has($allowedFilter) && $request->$allowedFilter !== '') {
                $query->where($allowedFilter, $request->$allowedFilter);
            }
        }

        // Relation Filters
        foreach (self::$relationFilters as $relation => $column) {
            if ($request->has($allowedFilter) && $request->$relation !== '') {
                $query->whereHas($relation, function ($queryRelation) use ($request, $column, $relation) {
                    if (is_array($request->$relation)) {
                        $queryRelation->whereIn($column, $request->$relation);
                    } else {
                        $queryRelation->where($column, $request->$relation);
                    }
                });
            }
        }
        return $query;
    }
}
