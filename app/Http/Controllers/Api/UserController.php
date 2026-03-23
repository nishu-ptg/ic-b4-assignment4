<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateUserRequest;
use App\Http\Resources\Api\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return apiResponse(new UserResource($user));
    }

    public function update(UpdateUserRequest $request)
    {
        $user = $request->user();

        $user->update($request->only('name', 'email'));

        return apiResponse(
            new UserResource($user->fresh()),
            'Profile updated successfully'
        );
    }

    public function destroy(Request $request)
    {
        $request->user()->delete();

        return response()->noContent();
    }
}
