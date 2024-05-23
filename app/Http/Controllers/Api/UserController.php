<?php

namespace App\Http\Controllers\Api;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\Api\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use Response;
    public function index(UserFilter $filters)
    {
        return UserResource::collection(User::filter($filters)->paginate());
    }

    public function show(UserFilter $filters, $user_id)
    {
        try {
            $user = User::filter($filters)->findOrFail($user_id);
            return new UserResource($user);
        } catch (ModelNotFoundException $exception) {
            return $this->error('User cannot be found or does not exist', 404);
        }
    }

    public function destroy($user_id){
        try {
            User::findOrFail($user_id)->delete();
            return $this->success("User Successfully deleted");
        } catch (ModelNotFoundException $exception) {
            return $this->error('User cannot be found', 404);
        }
    }
}
