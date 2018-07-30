<?php

namespace App\Observers;

use App\Adviser;

class AdviserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(Adviser $adviser)
    {
        $adviser->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }

     
}