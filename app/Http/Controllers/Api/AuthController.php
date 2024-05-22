<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\Api\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    use Response;
    public function login(LoginUserRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->error('Invalid Credentials: Check your email and password', 401);
        }

        $user = User::firstWhere('email', $request->email);

        return $this->success('Authenticated', [
            'token' => $user->createToken('API token for ' . $user->email, ['*', now()->addMonth()])->plainTextToken,
            'userData' => new UserResource($user)
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success('You have logged out successfully');
    }

    public function register(Request $request)
    {
        $userAttributes = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', "unique:users,email"],
            'password' => ['required', 'confirmed', Password::min(6)]
        ]);

        $employerAttributes = $request->validate([
            'employer' => ['required'],
            'logo' => ['required', 'image']
        ]);

        $logoPath = $request->logo->store('logo');

        $user = User::create($userAttributes);

        $user->employer()->create([
            'name' => $employerAttributes['employer'],
            'logo' => $logoPath
        ]);

        return $this->success('Registered successfully', ['token' => $user->createToken('API token for ' . $user->email, ['*', now()->addMonth()])->plainTextToken, 'userData' => new UserResource($user)]);
    }
}
