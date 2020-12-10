<?php

declare(strict_types=1);

namespace uMotif\Validator\LIVR\Rules;

final class ListLength
{
    private const FORMAT_ERROR = 'FORMAT_ERROR';
    private const TOO_FEW_ITEMS = 'TOO_FEW_ITEMS';
    private const TOO_MANY_ITEMS = 'TOO_MANY_ITEMS';

    public static function listLength($param1, $param2)
    {
        return function ($values) use ($param1, $param2) {
            if (!isset($param1) || $param1 === '' || $param2 < $param1) {
                return self::FORMAT_ERROR;
            }

            $minLen = $param1;
            (!isset($param2) || $param2 === '' || !is_string($param2) ) ? $maxLen = $param1 : $maxLen = $param2;

            if (!isset($values) || $values === '') {
                return;
            }

            if (!is_array($values)) {
                return self::FORMAT_ERROR;
            }

            $count = count($values);
            if ($count < $minLen) {
                return self::TOO_FEW_ITEMS;
            }
            if ($count > $maxLen) {
                return self::TOO_MANY_ITEMS;
            }

            return;
        };
    }
}
