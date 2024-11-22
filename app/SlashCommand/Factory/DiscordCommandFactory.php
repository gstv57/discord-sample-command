<?php

namespace App\SlashCommand\Factory;

use App\SlashCommand\Action\HelpCommand;
use App\SlashCommand\Action\StartCommand;
use App\SlashCommand\Action\WorkByLocationCommand;
use App\SlashCommand\Action\WorkByWordKeywordCommand;
use App\SlashCommand\Enums\CommandEnum;
use App\SlashCommand\Interface\DiscordCommandInterface;
use InvalidArgumentException;


class DiscordCommandFactory
{
    public function createCommand(CommandEnum $command): DiscordCommandInterface
    {
        return match ($command) {
            CommandEnum::WORK_BY_LOCATION => new WorkByLocationCommand(),
            CommandEnum::WORK_BY_WORD_KEYWORD => new WorkByWordKeywordCommand(),
            CommandEnum::HELP => new HelpCommand(),
            CommandEnum::START => new StartCommand(),
            default => throw new InvalidArgumentException('Comando inválido'),
        };
    }
}
