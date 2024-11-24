<?php

namespace App\SlashCommand\Interface;

use Discord\Parts\Embed\Embed;

interface EmbedInterface
{
    public function make(): Embed;
}
