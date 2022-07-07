<?php

namespace App\Traits;


trait Filterable
{
    public function scopeFilters($query, $request)
    {
        // Normal Filter without relations
        foreach (self::$filters as $allowedFilter) {
            if ($request->has($allowedFilter) && $this->isValidValue($request->$allowedFilter)) {
                $query->where($allowedFilter, 'like', '%' . $request->$allowedFilter . '%');
            }
        }

        // Relation Filters
        foreach (self::$relationFilters as $relation => $column) {
            if ($request->has($relation) && $this->isValidValue($request->$relation)) {
                $query->whereHas($relation, function ($queryRelation) use ($request, $column, $relation) {
                    if (is_array($request->$relation)) {
                        $queryRelation->whereIn($column, $request->$relation);
                    } else {
                        $queryRelation->where($column, 'like', '%' . $request->$relation . '%');
                    }
                });
            }
        }
        return $query;
    }

    public function isValidValue($value)
    {
        if ($value !== null && $value !== '') {
            return true;
        }
        return false;
    }
}
