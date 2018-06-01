<?php

namespace Aloweb\SitePreset;

use Illuminate\Foundation\Console\Presets\Preset as LaravelPreset;
use Illuminate\Support\Facades\File;

class Preset extends LaravelPreset
{
    public static function install()
    {
        static::deleteDefaultDirectories();
        static::createDirectories();
        static::cleanJavascriptDirectory();
        static::updatePackages();
        static::updateMix();
        static::copyBaseFiles();
    }

    /**
     * Delete the sass directory.
     */
    protected static function deleteSassDirectory()
    {
        File::deleteDirectory(resource_path('assets/sass'));
    }

    /**
     * Create the less directory.
     */
    protected static function createLessDirectory()
    {
        if (!File::isDirectory(resource_path('assets/less'))) {
            File::makeDirectory(resource_path('assets/less'));
        }
    }

    /**
     * Remove everything from the Javascript directory.
     */
    protected static function cleanJavascriptDirectory()
    {
        File::cleanDirectory(resource_path('assets/js'));
    }

    /**
     * Update the packages to only use the laravel mix.
     *
     * @return array
     */
    protected static function updatePackageArray()
    {
        return ['laravel-mix' => '^2.0'];
    }

    /**
     * Update the webpack mix file.
     */
    protected static function updateMix()
    {
        copy(__DIR__ . '/stubs/webpack.mix.js', base_path('webpack.mix.js'));
    }

    /**
     * Copy the base stub files to the project resources.
     */
    protected static function copyBaseFiles()
    {
        File::copyDirectory(__DIR__ . '/stubs/less', resource_path('assets/less'));
        File::copyDirectory(__DIR__ . '/stubs/js', resource_path('assets/js'));
    }

    /**
     * Delete the default directories that are not needed.
     */
    protected static function deleteDefaultDirectories()
    {
        static::deleteSassDirectory();

        File::deleteDirectory(public_path('css'));
        File::deleteDirectory(public_path('js'));
    }

    /**
     * Create all of the needed directories.
     */
    protected static function createDirectories()
    {
        static::createLessDirectory();
        File::makeDirectory(public_path('assets'));
        File::makeDirectory(public_path('assets/js'));
        File::makeDirectory(public_path('assets/css'));
    }
}
