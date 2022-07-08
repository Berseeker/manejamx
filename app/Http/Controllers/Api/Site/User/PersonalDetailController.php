<?php

namespace App\Http\Controllers\Api\Site\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\PersonalDetailRequestUpdate;
use App\Http\Resources\UserResource;
use App\Models\User;

class PersonalDetailController extends Controller
{
    public function update(User $user, PersonalDetailRequestUpdate $request)
    {
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return new UserResource($user);
    }

}
