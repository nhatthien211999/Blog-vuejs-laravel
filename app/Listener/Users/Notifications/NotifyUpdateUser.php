<?php

namespace App\Listener\Users\Notifications;

use App\Events\Users\UpdateUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUpdateUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdateUser  $event
     * @return void
     */
    public function handle(UpdateUser $event)
    {
        //
    }
}
