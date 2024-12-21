<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static extractKeyword(string $keyword)
 */
class Keyword extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'keyword';
    }
}
