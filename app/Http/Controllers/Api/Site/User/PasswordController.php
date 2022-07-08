<?php

namespace App\Http\Controllers\Api\Site\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\PasswordRequestUpdate;
use App\Http\Resources\UserResource;
use App\Models\User;

class PasswordController extends Controller
{
    public function update(User $user, PasswordRequestUpdate $request)
    {
        $user->password = bcrypt($request->password);

        $user->save();

        return new UserResource($user);
    }
}
