<?php

namespace App\Listener\Users\Logs;

use App\Models\UserLog;
use App\Events\Users\CreateUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogCreateUser
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
     * @param  CreateUser  $event
     * @return void
     */
    public function handle(CreateUser $event)
    {
        UserLog::create([
            'user_id' => $event->user->id,
            'slug' => 'created_user',
            'message' => 'Create user: '. $event->user->name.' by '.($event->created_by->name ?? "Not found ").' on: '. $event->created_at,
            'metadata' => [
                'user'=>$event->user, 
                'created_by' => $event->created_by, 
                'created_at' => $event->created_at
            ],
        ]);
        return true;
    }
}
