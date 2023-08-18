<?php

namespace Opensaucesystems\Lxd\Helpers;

/**
 * Inspired by Laravel
 * https://github.com/illuminate/support/blob/master/Str.php
 */
class Str
{
    /**
     * The cache of studly-cased words.
     *
     * @var array
     */
    protected static $studlyCache = [];

    /**
     * Convert a value to studly caps case.
     *
     * @param  string  $value
     * @return string
     */
    public static function studly($value)
    {
        $key = $value;

        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }

        $words = explode(' ', str_replace(['-', '_'], ' ', $value));

        $studlyWords = array_map(function ($word) { return ucfirst($word); }, $words);

        return static::$studlyCache[$key] = implode($studlyWords);
    }
}
