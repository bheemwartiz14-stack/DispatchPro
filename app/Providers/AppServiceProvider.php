<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

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
        $this->configureDefaults();
        $this->configureAssetUrls();
    }

    /**
     * Resolve asset URLs against the request root so the app works when
     * served from a subdirectory (e.g. https://host/DispatchPro). Honors an
     * explicit ASSET_URL (CDN/custom base) when one is configured.
     */
    protected function configureAssetUrls(): void
    {
        Vite::createAssetPathsUsing(function (string $path, ?bool $secure = null): string {
            return config('app.asset_url')
                ? asset($path, $secure)
                : url($path, [], $secure);
        });
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }
}
