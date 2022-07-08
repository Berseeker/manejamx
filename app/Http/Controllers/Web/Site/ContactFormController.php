<?php

namespace App\Http\Controllers\Web\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactFormRequestStore;
use App\Notifications\ContactForm;
use Illuminate\Support\Facades\Notification;

class ContactFormController extends Controller
{
    public function store(ContactFormRequestStore $request)
    {
        Notification::route('mail', env('MAIL_FROM_ADDRESS'))
            ->notify(new ContactForm(
                $request->name,
                $request->phone,
                $request->email,
                $request->message

            ));

        return response()->json();
    }
}
