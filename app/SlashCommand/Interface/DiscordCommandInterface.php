<?php

namespace App\SlashCommand\Interface;

use Discord\Discord;
use Discord\Parts\Channel\Message;

interface DiscordCommandInterface
{
    public function executeCommand(Message $message, Discord $discord): void;
}
