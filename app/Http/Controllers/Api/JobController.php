<?php

namespace App\Http\Controllers\Api;

use App\Filters\JobFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ReplaceJobRequest;
use App\Http\Requests\Api\StoreJobRequest;
use App\Http\Requests\Api\UpdateJobRequest;
use App\Http\Resources\JobResource;
use App\Models\Employer;
use App\Models\Job;
use App\Traits\Api\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\HttpException;

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
     * Store a newly created resource in storage.
     */
    public function store(StoreJobRequest $request)
    {
        $attributes = $request->all();
        try {
            $user = Auth::guard('sanctum')->user();
            $employer = Employer::firstWhere('user_id', $user->id);
            $attributes['employer_id'] = $employer->id;
        } catch (HttpException $exception) {
            if ($exception->getCode() === 401) {
                return $this->error('Unauthorized', 401);
            }
            throw $exception; // Re-throw other exceptions
        }


        $attributes['featured'] = $request->has('featured');
        $job = Job::create(Arr::except($attributes, 'tags'));
        if ($attributes['tags'] ?? false) {
            foreach (explode(',', $attributes['tags']) as $tag) {
                $job->tag($tag);
            }
        }

        return new JobResource($job);
    }

    /**
     * Display the specified resource.
     */
    public function show($job_id)
    {
        try {
            $job = Job::findOrFail($job_id)->load(['employer', 'tags']);
            return new JobResource($job);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Job cannot be found', 404);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobRequest $request, $job_id)
    {
        try {
            $job = Job::findOrFail($job_id);
            Gate::authorize('modify', $job);
            $attributesToUpdate = $request->mappedAttributes();
            if ($attributesToUpdate['tags'] ?? false) {
                foreach (explode(',', $attributesToUpdate['tags']) as $tag) {
                    $job->tag($tag);
                }
            }
            $job->update(Arr::except($attributesToUpdate, 'tags'));
            return new JobResource($job);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Job not found', 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($job_id)
    {
        try {
            $job = Job::findOrFail($job_id);
            Gate::authorize('modify', $job);
            $job->delete();
            return $this->success("Job Successfully deleted");
        } catch (ModelNotFoundException $exception) {
            return $this->error('Job cannot be found', 404);
        } catch (AuthorizationException $exception) {
            return $this->error('You cannot edit this job', 404);
        }
    }
}
