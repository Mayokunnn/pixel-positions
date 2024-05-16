<?php

namespace App\Http\Controllers;

use App\Models\Job;

class SearchController extends Controller
{
    public function __invoke()
    {
        $jobs = Job::where('title', 'LIKE', '%' . request('q') . '%')->orWhereHas('employer', function ($query) {
            $query->where('name', 'LIKE', '%' . request('q') . '%');
        })->orWhereHas('tags', function ($query) {
            $query->where('name', 'LIKE', '%' . request('q') . '%');
        })
            ->get();
//        dd($jobs);
        return view('results', ['jobs' => $jobs, 'query' => request('q')]);
    }
}
