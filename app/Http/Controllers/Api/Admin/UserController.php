<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequestStore;
use App\Http\Requests\Admin\UserRequestUpdate;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return UserResource::collection(
            User::with('roles')
                //->where('client', false)
                ->role(['admin', 'employee'])
                ->orderByDesc('id')
                ->paginate(15)
        );
    }

    public function store(UserRequestStore $request)
    {
        $user = User::create($request->validated());

        $user->syncRoles(array_column($request->roles, 'id'));

        $user->update([
            'client' => $user->hasRole('client')
        ]);

        return new UserResource($user);
    }

    public function update(UserRequestUpdate $request, User $user)
    {
        $user->update($request->validated());

        $user->syncRoles(array_column($request->roles, 'id'));

        $user->update([
            'client' => $user->hasRole('client')
        ]);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true
        ], 204);
    }
}
