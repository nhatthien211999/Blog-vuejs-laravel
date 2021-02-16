<?php

namespace App\Listener\Users\Logs;

use App\Models\UserLog;
use App\Events\Users\UpdateUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUpdateUser
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
        UserLog::create([
            'user_id' => $event->user->id,
            'slug' => 'updated_user',
            'message' => 'Updated user: '. $event->user->name.' by '.($event->updated_by->name ?? "Not found ").' on: '. $event->updated_at,
            'metadata' => [
                'user'=>$event->user, 
                'updated_by' => $event->updated_by, 
                'updated_at' => $event->updated_at
            ],
        ]);
        
        return true;
    }
}
