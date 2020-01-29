<?php

namespace App\Providers;

use App\Models\Ticket\Comment;
use App\Models\Ticket\Ticket;
use App\Observers\CommentObserver;
use App\Observers\TicketObserver;
use Illuminate\Support\ServiceProvider;
use URL;

/**
 * Class AppServiceProvider
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        if (env('APP_ENABLE_SSL', false)) {
            URL::forceScheme('https');
        }
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        Ticket::observe(TicketObserver::class);
        Comment::observe(CommentObserver::class);
    }
}
