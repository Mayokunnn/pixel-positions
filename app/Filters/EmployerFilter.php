<?php

namespace App\Filters;


class EmployerFilter extends QueryFilter
{
    protected $sortable = ['name', 'id', 'createdAt' => 'created_at', 'updatedAt' => 'updated_at'];

    public function include($value){
        return $this->builder->with($value);
    }

    public function name($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('name', 'LIKE' ,$likeStr);
    }

    public function updatedAt($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('updated_at', $dates);
        }

        return $this->builder->whereDate('updated_at', $dates);
    }

    public function createdAt($value)
    {
        $dates = explode(',', $value);

        if (count($dates) > 1) {
            return $this->builder->whereBetween('created_at', $dates);
        }

        return $this->builder->whereDate('created_at', $dates);
    }

}
