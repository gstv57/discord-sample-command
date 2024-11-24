<?php

namespace App\SlashCommand\Action;

use App\Facades\Keyword;
use App\Jobs\UpdateLastSend;
use App\Models\Opportunity;
use App\SlashCommand\EmbedMessage\OpportunityEmbed;
use App\SlashCommand\Interface\DiscordCommandInterface;
use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;

class WorkNewByWordCommand implements DiscordCommandInterface
{
    public function executeCommand(Message $message, Discord $discord): void
    {
        $keyword = Keyword::extractKeyword($message->content);

        $query = Opportunity::where('last_sent_at', '=', null)
            ->where('job_details', 'like', "%$keyword%")
            ->orWhere('title', 'like', "%$keyword%");

        $message->author->sendMessage("Olá, $message->author. Encontrei {$query->count()} oportunidades com a palavra-chave $keyword.");

        $jobs = $query->pluck('id')->toArray();

        foreach ($query->get() as $opportunity) {
            $embed = new OpportunityEmbed(new Embed($discord), $opportunity, $message);
            $message->author->sendMessage('', false, $embed->make());
            time_nanosleep(0, 300000000);
        }

        $message->channel->sendMessage("Olá, $message->author. Enviei as oportunidades com a palavra-chave $keyword no seu privado.");

        dispatch(new UpdateLastSend($jobs));
    }
}
