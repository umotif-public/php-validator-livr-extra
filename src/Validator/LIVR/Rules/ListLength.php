<?php

declare(strict_types=1);

namespace uMotif\Validator\LIVR\Rules;

final class ListLength
{
    const FORMAT_ERROR = 'FORMAT_ERROR';

    public static function listLength($param1, $param2)
    {
        return function ($values) use ($param1, $param2) {
            if (!isset($param1) || $param1 === '' || $param2 < $param1) {
                return self::FORMAT_ERROR;
            }

            $minLen = $param1;
            (!isset($param2) || $param2 === '' || !is_string($param2) ) ? $maxLen = $param1 : $maxLen = $param2;

            if (!isset($values) || $values === '') {
                return null;
            }

            if (!is_array($values)) {
                return ListLength::FORMAT_ERROR;
            }

            $count = count($values);
            if ($count < $minLen) {
                return 'TOO_FEW_ITEMS';
            }
            if ($count > $maxLen) {
                return 'TOO_MANY_ITEMS';
            }

            return null;
        };
    }
}
