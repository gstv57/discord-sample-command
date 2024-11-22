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
    protected $signature = 'discord-execute';

    protected $description = 'Run the Discord bot';

    public function __construct(private readonly DiscordCommandHandler $commandHandler)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        try {
            $discord = new Discord([
                'token'   => config('services.discord.token'),
                'intents' => Intents::getDefaultIntents() | Intents::MESSAGE_CONTENT,
            ]);

        } catch (IntentException $e) {
            $this->error($e->getMessage());
            return;
        }

        $discord->on('ready', function (Discord $discord) {
            $commands = implode(', ', array_map(fn ($command) => $command->value, CommandEnum::cases()));
            $this->info("Bot is ready! Listening to commands: $commands");
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
}
