<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;
use Spatie\Translatable\Facades\Translatable;

class AppServiceProvider extends ServiceProvider
{
    use LoadsTranslatedCachedRoutes;
    
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

        RouteServiceProvider::loadCachedRoutesUsing(fn () => $this->loadCachedRoutes());

        //Sometimes it is favored to return any translation 
        //if neither the translation for the preferred locale nor the fallback locale are set.
        //  Translatable::fallback(
        //         fallbackAny: true,
        // );
        Translatable::fallback(missingKeyCallback: function (
            Model $model, 
            string $translationKey, 
            string $locale, 
            string $fallbackTranslation, 
            string $fallbackLocale,
        ) {

                // do something (ex: logging, alerting, etc)
                
                Log::warning('Some translation key is missing from an eloquent model', [
                'key' => $translationKey,
                'locale' => $locale,
                'fallback_locale' => $fallbackLocale,
                'fallback_translation' => $fallbackTranslation,
                'model_id' => $model->id,
                'model_class' => get_class($model), 
                ]);
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
            : null
        );
    }
}
