<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        return view('results', ['jobs' => $tag->jobs()->latest()->with('employer', 'tags')->get(), 'query' => $tag->name]);
    }
}
