<?php

namespace App\Providers;

use App\Helpers\KeywordHelper;
use App\SlashCommand\Factory\DiscordCommandFactory;
use App\SlashCommand\Handler\DiscordCommandHandler;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('keyword', function () {
            return new KeywordHelper();
        });

        $this->app->bind(DiscordCommandFactory::class, function () {
            return new DiscordCommandFactory();
        });

        $this->app->bind(DiscordCommandHandler::class, function ($app) {
            return new DiscordCommandHandler(
                $app->make(DiscordCommandFactory::class)
            );
        });
    }
    public function boot(): void
    {
        //
    }
}
