<?php

namespace App\Traits;

trait FilterableTrait
{
    protected function scopeFilter($query, array $filters, array $fields = [])
    {
        return $query
            ->when($filters['search'] ?? null, function ($query, $search) use ($fields) {
                    $query->where(function ($query) use ($search, $fields) {
                        // defaults to looking for 'name' field, else it will check for the succeeding IF clause
                        if ($fields === []) {
                            $query->where('name', 'ilike', '%'.$search.'%');
                        }

                        if ($fields !== []) {
                            foreach ($fields as $index => $field) {
                                if ($index === 0) {
                                    $query->where($field, 'ilike', '%'.$search.'%');
                                } else {
                                    $query->orWhere($field, 'ilike', '%'.$search.'%');
                                }

                            }
                        }
                    });

            })
            ->when($filters['trashed'] ?? null, function ($query, $trashed) {
                if ($trashed === 'with') {
                    $query->withTrashed();
                }

                if ($trashed === 'only') {
                    $query->onlyTrashed();
                }
            });
    }
}
