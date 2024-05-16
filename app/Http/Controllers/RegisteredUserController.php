<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        return redirect('/');

    }

    /**
     * Show the forms for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }


}
