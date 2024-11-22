<?php

namespace App\SlashCommand\Action;

use App\SlashCommand\Interface\DiscordCommandInterface;
use Discord\Discord;
use Discord\Parts\Channel\Message;

class WorkByLocationCommand implements DiscordCommandInterface
{

    public function executeCommand(Message $message, Discord $discord): void
    {
    }
}
