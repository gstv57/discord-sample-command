<?php

namespace App\SlashCommand\Enums;

enum CommandEnum: string
{
    case WORK_BY_WORD_KEYWORD = '/work-by-word-keyword';
    case WORK_BY_LOCATION     = '/work-by-location';
    case HELP                 = '/help';
    case START                = '/start';
}
