<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\PostNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class PostListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        // User::all()->except($post->user_id)->each(function(User $user) use ($post){$user->notify(new PostNotification($post));});
        User::whereKeyNot($event->post->user_id)
            ->each(fn (User $user) => $user->notify(new PostNotification($event->post)));

        // $clientes = User::role('cliente')->get(); // si usas spatie/laravel-permission
        // Notification::send($clientes, new PostNotification($event->post));
    }
}
