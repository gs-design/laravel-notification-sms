<?php


namespace GsDesign\SMS;

use Illuminate\Support\ServiceProvider;

class SMSServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the applications services.
     */
    public function boot()
    {
        $this->app->when(SMSChannel::class)
            ->needs(SMS::class)
            ->give(function() {
                return new SMS(
                    config('services.sms.host'),
                    config('services.sms.key'),
                    config('services.sms.from')
                );
            });
    }

    /**
     * Register any packages services.
     */
    public function register()
    {
    }

}