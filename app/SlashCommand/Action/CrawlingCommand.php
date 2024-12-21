<?php

namespace App\SlashCommand\Action;

use App\Facades\Keyword;
use App\Services\Seek\GetJobsOnPage;
use App\SlashCommand\Interface\DiscordCommandInterface;
use Discord\Discord;
use Discord\Parts\Channel\Message;

class CrawlingCommand implements DiscordCommandInterface
{
    public function executeCommand(Message $message, Discord $discord): void
    {
        $keywork = Keyword::extractKeyword($message->content) . '-jobs';

        dispatch(new GetJobsOnPage($keywork));

        $message->reply('Crawling jobs for ' . $keywork . ' started');
    }
}
