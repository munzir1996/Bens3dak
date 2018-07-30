<?php

namespace App\Observers;

use App\Manager;

class ManagerObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function creating(Manager $manager)
    {
        $manager->api_token = bin2hex(openssl_random_pseudo_bytes(30));
    }

     
}