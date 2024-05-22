<?php

namespace App\Http\Controllers\Api;

use App\Filters\JobFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\JobResource;
use App\Models\Job;
use App\Traits\Api\Response;
use Illuminate\Http\Request;

class JobController extends Controller
{
    use Response;
    /**
     * Display a listing of the resource.
     */
    public function index(JobFilter $filters)
    {
        $jobs = Job::filter($filters)->latest()->with('employer', 'tags')->paginate();

        return JobResource::collection($jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
