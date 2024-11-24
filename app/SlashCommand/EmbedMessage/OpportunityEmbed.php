<?php

namespace App\SlashCommand\EmbedMessage;

use App\Models\Opportunity;
use App\SlashCommand\Interface\EmbedInterface;
use Discord\Parts\Channel\Message;
use Discord\Parts\Embed\Embed;
use Illuminate\Support\Str;

class OpportunityEmbed implements EmbedInterface
{
    public function __construct(private readonly Embed $embed, public Opportunity $opportunity, public Message $message)
    {
    }
    public function make(): Embed
    {
        $this->embed->title       = '💼 ' . $this->opportunity->title;
        $this->embed->description = "**Resumo da Vaga:**\n" .
            Str::limit($this->opportunity->job_details, 300) .
            "\n\n🔗 [Acesse a vaga completa aqui!](" . $this->opportunity->url . ")";
        $this->embed->url = $this->opportunity->url;

        $this->embed->color = 0x1ABC9C;

        $this->embed->footer = [
            'text'     => 'Encontrado por: ' . $this->message->author->username,
            'icon_url' => $this->message->author->avatar,
        ];

        $this->embed->timestamp = now()->toISOString();

        $this->embed->addField([
            'name'   => '📍 Localização',
            'value'  => $this->opportunity->location ?? 'Não informado',
            'inline' => true,
        ]);

        $this->embed->addField([
            'name'   => '💰 Salário',
            'value'  => $this->opportunity->salary ?? 'A negociar',
            'inline' => true,
        ]);

        $this->embed->addField([
            'name'   => '🖋️ Anunciante',
            'value'  => $this->opportunity->advertiser ?? 'Desconhecido',
            'inline' => true,
        ]);

        return $this->embed;
    }
}
