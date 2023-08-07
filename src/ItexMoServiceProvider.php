<?php


namespace Codelines\LaravelItexmo;


use Illuminate\Support\ServiceProvider;

class ItexMoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/itexmo.php', 'itexmo');
    }
}