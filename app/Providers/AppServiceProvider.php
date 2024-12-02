<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $notifications = Notification::where('is_read', false)->get();

        // // Bagikan notifikasi ke semua view
        // View::share('notifications', $notifications);
        view()->composer('*', function ($view) {
            $unreadNotifications = Notification::where('is_read', false)->get();
            $view->with('notifications', $unreadNotifications); // Hanya kirimkan unread notifications
        });

        $locale = Session::get('locale', 'id'); // Default ke bahasa Indonesia
        App::setLocale($locale);
    }
}
