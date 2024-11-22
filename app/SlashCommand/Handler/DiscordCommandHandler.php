<?php

namespace App\SlashCommand\Handler;

use App\SlashCommand\Enums\CommandEnum;
use App\SlashCommand\Factory\DiscordCommandFactory;
use Discord\Discord;
use Discord\Parts\Channel\Message;

class DiscordCommandHandler
{
    private DiscordCommandFactory $commandFactory;

    public function __construct(DiscordCommandFactory $commandFactory)
    {
        $this->commandFactory = $commandFactory;
    }
    public function handle(CommandEnum $command, Message $message, Discord $discord): void
    {
        $commandInstance = $this->commandFactory->createCommand($command);
        $commandInstance->executeCommand($message, $discord);
    }
}
