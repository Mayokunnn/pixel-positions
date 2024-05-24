<?php

namespace App\Http\Controllers\Api;

use App\Filters\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\Api\Response;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

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

    public function update(UpdateUserRequest $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);

            Gate::authorize('modify', $user);

            $attributesToUpdate = $request->mappedAttributes();

            if (array_key_exists('newPassword', $attributesToUpdate)) {
                $request->user()->currentAccessToken()->delete();
                $attributesToUpdate['password'] = $attributesToUpdate['newPassword'];
                unset($attributesToUpdate['newPassword'], $attributesToUpdate['oldPassword']);
            }

            // return $attributesToUpdate;
            $user->update($attributesToUpdate);

            return new UserResource($user);
        } catch (ModelNotFoundException $exception) {
            return $this->error('User not found', 404);
        } catch (AuthorizationException $exception) {
            return $this->error('You are not authorized to update this user', 403);
        }
        // } catch (Exception $exception) {
        //     return $this->error('An unexpected error occurred', 500);
        // }
    }



    public function destroy(Request $request, $user_id)
    {
        try {
            $user = User::findOrFail($user_id);
            Gate::authorize('modify', $user);
            $request->user()->currentAccessToken()->delete();
            $user->delete();
            return $this->success("User Successfully deleted");
        } catch (ModelNotFoundException $exception) {
            return $this->error('User cannot be found', 404);
        }
    }
}
