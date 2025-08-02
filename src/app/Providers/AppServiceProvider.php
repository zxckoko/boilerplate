<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Vite;
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
        Vite::prefetch(concurrency: 3);

        RateLimiter::for('default', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->configureAuthToCustomPackages();
    }

    private function configureAuthToCustomPackages(): void
    {
        Gate::define('viewPulse', function () {
            return request()->user() && request()->user()->hasRole('Administrator');
        });

        Gate::define('viewHorizon', function () {
            return request()->user() && request()->user()->hasRole('Administrator');
        });

        Gate::define('viewTelescope', function () {
            return request()->user() && request()->user()->hasRole('Administrator');

        });

        /*
         * INSECURE: https://log-viewer.opcodes.io/docs/3.x/configuration/access-to-log-viewer
         * - tried all implementations decsribed in the document above
         * - Gate, Auth, Spatie custom middleware
         * - EITHER Removal of "\Opcodes\LogViewer\Http\Middleware\EnsureFrontendRequestsAreStateful::class,"
         * - OR removal of Gate (any) check will only work... which makes access insecure
         * */
        // Gate::define('viewLogViewer', function () {
        //     return request()->user() && request()->user()->hasRole('Administrator');
        // });
    }
}
