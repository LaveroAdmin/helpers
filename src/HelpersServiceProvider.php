<?php

namespace LaveroAdmin\Admin\Helpers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'lavero-admin-helpers');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'lavero-admin-helpers');

        Helpers::boot();
    }
}
