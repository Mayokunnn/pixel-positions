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
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\HttpException;

class EmployerJobController extends Controller
{
    use Response;
    public function index($employer_id, JobFilter $filters)
    {
        try {
            $employer = Employer::findOrFail($employer_id);
            return JobResource::collection(Job::filter($filters)->where('employer_id', $employer->id)->paginate());
        } catch (ModelNotFoundException $exception) {
            return $this->error('Employer does not exist', 404);
        }
    }

    public function show($employer_id, $job_id)
    {
        try {
            $employer = Employer::findOrFail($employer_id);
            $job = Job::firstWhere('id', $job_id);
            if ($job->employer_id != $employer->id) {
                return $this->error('Employer does not own this job', 403);
            }

            return new JobResource($job);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Job does not exist', 404);
        }
    }

    public function store(StoreJobRequest $request, $employer_id)
    {
        $attributes = $request->all();
        try {
            $employer = Employer::firstWhere('id', $employer_id);
            Gate::authorize('create', $employer);
            $attributes['employer_id'] = $employer_id;
        } catch (AuthorizationException $ex) {
            return $this->error('Unauthorized', 401);
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

    public function update(UpdateJobRequest $request, $employer_id, $job_id)
    {
        try {
            $job = Job::findOrFail($job_id);
            $employer = Employer::firstWhere('id', $employer_id);
            Gate::authorize('create', $employer);
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
        } catch (AuthorizationException $ex) {
            return $this->error('You cannot edit this job', 401);
        }
    }


    public function destroy($employer_id , $job_id)
    {
        try {
            $job = Job::findOrFail($job_id);
            $employer = Employer::firstWhere('id', $employer_id);
            Gate::authorize('create', $employer);
            Gate::authorize('modify', $job);
            $job->delete();
            return $this->success("Job Successfully deleted");
        } catch (ModelNotFoundException $exception) {
            return $this->error('Job cannot be found', 404);
        } catch (AuthorizationException $exception) {
            return $this->error('You cannot delete this job', 404);
        }
    }
}
