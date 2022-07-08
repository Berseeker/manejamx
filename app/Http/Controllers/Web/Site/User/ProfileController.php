<?php

namespace App\Http\Controllers\Web\Site\User;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('site.users.index', compact('user'));
    }
}