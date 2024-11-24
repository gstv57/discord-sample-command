<?php

namespace App\SlashCommand\Action;

use App\SlashCommand\Enums\CommandEnum;
use App\SlashCommand\Interface\DiscordCommandInterface;
use Discord\Discord;
use Discord\Parts\Channel\Message;

class HelpCommand implements DiscordCommandInterface
{
    public function executeCommand(Message $message, Discord $discord): void
    {
        $commands = CommandEnum::toArray();

        $commands = array_map(function ($comando) {
            return '`' . $comando->value . '`';
        }, $commands);

        $message->channel->sendMessage('Comandos disponíveis: ' . implode(', ', $commands));
    }
}
