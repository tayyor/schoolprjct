<?php

namespace App\Providers;

class SentryErrorProvider extends \Sentry\SentryLaravel\SentryLaravelServiceProvider
{

    public static $abstract = 'sentryerror';
    
}
