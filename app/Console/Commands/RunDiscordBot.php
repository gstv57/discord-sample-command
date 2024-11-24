<?php

namespace App\Console\Commands;

use App\SlashCommand\Enums\CommandEnum;
use App\SlashCommand\Handler\DiscordCommandHandler;
use Discord\Discord;
use Discord\Exceptions\IntentException;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\{Event, Intents};
use Illuminate\Console\Command;

class RunDiscordBot extends Command
{
    protected $signature = 'discord:start';

    private static ?Discord $discordInstance = null;

    public function __construct(private readonly DiscordCommandHandler $commandHandler)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $discord = $this->getDiscordInstance();

        if ($discord === null) {
            return;
        }

        $discord->on('init', function (Discord $discord) {
            $commands = implode(', ', array_map(fn ($command) => $command->value, CommandEnum::cases()));

            $this->info("Commands: $commands");

            $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
                $commandContent = $message->content;

                foreach (CommandEnum::cases() as $command) {
                    if (!preg_match('/^' . preg_quote($command->value, '/') . '\b/', $commandContent)) {
                        continue;
                    }

                    $this->commandHandler->handle($command, $message, $discord);

                    return;
                }
            });
        });

        $discord->run();
    }

    private function getDiscordInstance(): ?Discord
    {
        if (self::$discordInstance === null) {
            try {
                self::$discordInstance = new Discord([
                    'token'   => config('services.discord.token'),
                    'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
                ]);
            } catch (IntentException $e) {
                $this->error($e->getMessage());

                return null;
            }
        }

        return self::$discordInstance;
    }
}
