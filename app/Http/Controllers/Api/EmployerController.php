<?php

namespace App\Http\Controllers\Api;

use App\Filters\EmployerFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployersResource;
use App\Models\Employer;
use App\Traits\Api\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    use Response;
    public function index(EmployerFilter $filters)
    {
        return EmployersResource::collection(Employer::filter($filters)->get());
    }

    public function show(EmployerFilter $filters, $employer_id)
    {
        try {
            $employer = Employer::filter($filters)->findOrFail($employer_id);
            return new EmployersResource($employer);
        } catch (ModelNotFoundException $exception) {
            return $this->error('Tag not found', 404);
        }
    }
}
