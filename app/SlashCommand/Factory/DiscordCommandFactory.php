<?php

namespace App\SlashCommand\Factory;

use App\SlashCommand\Action\{CrawlingCommand,
    HelpCommand,
    WorkByAdvertisingCommand,
    WorkKeywordCommand,
    WorkKeywordLocationCommand,
    WorkLocationCommand,
    WorkNewByWordCommand};
use App\SlashCommand\Enums\CommandEnum;
use App\SlashCommand\Interface\DiscordCommandInterface;
use InvalidArgumentException;

class DiscordCommandFactory
{

    public function createCommand(CommandEnum $command): DiscordCommandInterface
    {
        return match ($command) {
            CommandEnum::HELP                         => new HelpCommand(),
            CommandEnum::START_CRAWLING               => new CrawlingCommand(),
            CommandEnum::WORK_BY_WORD_KEYWORD         => new WorkKeywordCommand(),
            CommandEnum::WORK_NEWS_BY_WORD_KEYWORD    => new WorkNewByWordCommand(),
            CommandEnum::WORK_BY_ADVERTISING          => new WorkByAdvertisingCommand(),
            default                                   => throw new InvalidArgumentException('Command not exists.'),
        };
    }
}
