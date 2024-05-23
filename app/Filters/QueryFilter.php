<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class QueryFilter{
    protected $builder;
    protected $request;
    protected $sortable = [];

    public function __construct(Request $request){
        $this->request = $request;


    }

    public function include($value){
        return $this->builder->with($value);
    }


    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach ($this->request->all() as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }

        return $builder;
    }

    public function filter($arr){
        foreach ($arr as $key => $value) {
            if (method_exists($this, $key)) {
                $this->$key($value);
            }
        }
    }

    protected function sort($value)
    {
        $sortAttributes = explode(',', $value);

        foreach ($sortAttributes as $sortAttribute) {
            $direction = 'asc';

            if (strpos($sortAttribute, '-') === 0) {
                $direction = 'desc';
                $sortAttribute = substr($sortAttribute, 1);
            }

            if (!in_array($sortAttribute, $this->sortable) && !array_key_exists($sortAttribute, $this->sortable)) {
                continue;
            }

            $columnName = $this->sortable[$sortAttribute] ?? null;

            if ($columnName === null) {
                $columnName = $sortAttribute;
            }

            $this->builder->orderBy($columnName, $direction);
        }
    }

}