<?php

namespace App\Providers;

use App\SlashCommand\Action\WorkByLocationCommand;
use App\SlashCommand\Action\WorkByWordKeywordCommand;
use App\SlashCommand\Factory\DiscordCommandFactory;
use App\SlashCommand\Handler\DiscordCommandHandler;
use App\Console\Commands\RunDiscordBot;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(WorkByLocationCommand::class, function ($app) {
            return new WorkByLocationCommand(
            # $app->make(LocationService::class)
            );
        });

        $this->app->bind(WorkByWordKeywordCommand::class, function ($app) {
            return new WorkByWordKeywordCommand(
                # $app->make(KeywordService::class)
            );
        });

        // Registra a factory
        $this->app->bind(DiscordCommandFactory::class, function ($app) {
            return new DiscordCommandFactory();
        });

        // Registra o handler principal
        $this->app->bind(DiscordCommandHandler::class, function ($app) {
            return new DiscordCommandHandler(
                $app->make(DiscordCommandFactory::class)
            );
        });
    }
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
