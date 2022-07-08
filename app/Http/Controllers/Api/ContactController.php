<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ContactFormRequestStore;
use App\Notifications\ContactForm;
use Illuminate\Support\Facades\Notification;

class ContactController extends Controller
{
    public function store(ContactFormRequestStore $request)
    {

        $to = $request->from_calculator ? ['ventas@maneja.mx', 'gerencia@maneja.mx'] : env('MAIL_FROM_ADDRESS');

        Notification::route('mail', $to)
            ->notify(new ContactForm(
                $request->name,
                $request->phone,
                $request->email,
                $request->message,
                $request->from_calculator,
                $request->calculator_inputs
            ));

        return response([],200);
    }

}
