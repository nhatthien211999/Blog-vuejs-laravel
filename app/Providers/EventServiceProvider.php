<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\Users\CreateUser' => [
            'App\Listener\Users\Logs\LogCreateUser',
            'App\Listener\Users\Notifications\NotifyCreateUser',
        ],
        'App\Events\Users\DeletingUser' => [
            'App\Listener\Users\Logs\LogDeletingUser',
            'App\Listener\Users\Notifications\NotifyDeletingUser',
        ],
        'App\Events\Users\UpdateUser' => [
            'App\Listener\Users\Logs\LogUpdateUser',
            'App\Listener\Users\Notifications\NotifyUpdateUser',
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
