<?php

namespace Aloweb\SitePreset;

use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\Support\ServiceProvider;

class AlowebServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('sites', function ($command) {
            Preset::install();
        });
    }
}
