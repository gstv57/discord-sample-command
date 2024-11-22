<?php

namespace App\SlashCommand\Action;

use App\SlashCommand\Interface\DiscordCommandInterface;
use Discord\Discord;
use Discord\Parts\Channel\Message;

class StartCommand implements DiscordCommandInterface
{

    public function executeCommand(Message $message, Discord $discord): void
    {
    }
}
