<?php

namespace App\Http\Controllers\Api\Site\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;

class NotificationController extends Controller
{
    public function update(User $user)
    {
        $user->notifications = ! $user->notifications;

        $user->save();

        return new UserResource($user);
    }

}
