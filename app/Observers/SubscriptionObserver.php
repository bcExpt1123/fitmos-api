<?php

namespace App\Observers;

use App\Subscription;
use App\Config;

class SubscriptionObserver
{
    /**
     * Handle the subscription "saved" event.
     *
     * @param  \App\Subscription  $subscription
     * @return void
     */
    public function saved(Subscription $subscription)
    {
        $config = new Config;
        $config->updateConfig('public_profile', time());
    }
}
