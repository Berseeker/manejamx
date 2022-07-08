<?php

namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class ValidRecaptcha implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(app()->environment() == 'production' ) {
            $client = new Client([
                'base_uri' => 'https://www.google.com/recaptcha/api/'
            ]);

            $response = $client->post('siteverify', [
                'query' => [
                    'secret'   => env('RECAPTCHA_V3_SECRET_KEY'),
                    'response' => $value
                ]
            ]);

            return json_decode($response->getBody())->success;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ReCaptcha Fallido.';
    }
}
