<?php

namespace App\Filters;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class JobFilter extends QueryFilter
{

    protected $sortable = ['title', 'salary', 'location', 'schedule', 'url', 'createdAt' => 'created_at', 'updatedAt' => 'updated_at'];
    public function title($value)
    {
        $likeStr = str_replace('*', '%', $value);
        return $this->builder->where('title', 'like', $likeStr);
    }

    public function salary($value)
    {
        $salaries = explode(',', $value);

        if (count($salaries) > 1) {
            return $this->builder->whereBetween('salary', $salaries);
        }

        return $this->builder->whereDate('salary', $salaries);
    }

    public function location($value)
    {
        return $this->builder->whereIn('location', explode(',', $value));
    }

    public function schedule($value)
    {
        return $this->builder->where('schedule', $value);
    }

    public function url($value)
    {
        return $this->builder->where('url', $value);
    }

    public function featured($value)
    {
        if ($value === 'true') {
            return $this->builder->where('featured', 1);
        } else if ($value === 'false') {
            return
                $this->builder->where('featured', 0);
        }
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
