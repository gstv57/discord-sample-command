<?php

namespace App\SlashCommand\Enums;

enum CommandEnum: string
{
    case HELP                         = '/help';
    case START_CRAWLING               = '/crawling';
    case WORK_BY_WORD_KEYWORD         = '/work-keyword';
    case WORK_NEWS_BY_WORD_KEYWORD    = '/work-news-keyword';
    case WORK_BY_ADVERTISING          = '/work-advertising';
    public static function toArray(): array
    {
        return [
            self::START_CRAWLING,
            self::HELP,
            self::WORK_BY_WORD_KEYWORD,
            self::WORK_NEWS_BY_WORD_KEYWORD,
            self::WORK_BY_ADVERTISING,
        ];
    }
}
