<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Tables\Users;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        return Inertia::render(
            'users/Index',
            ['users' => Users::make()]
        );
    }

    public function show(User $user)
    {
        return Inertia::render(
            'users/Show',
            [
                'user' => $user
            ]
        );
    }

    public function edit(User $user)
    {
        return Inertia::render('users/Edit', ['user' => $user]);
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user->update($request->validated());

        return to_route('users.index')->with('status', 'User updated successfully.');
    }
}
