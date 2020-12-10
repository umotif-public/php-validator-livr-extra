<?php

declare(strict_types=1);

namespace uMotif;

use Validator\LIVR as LIVRBase;

class LIVR extends LIVRBase
{
    private static array $extraRules = [
        'list_length' => 'uMotif\Validator\LIVR\Rules\ListLength::listLength',
    ];

    public function __construct($livrRules, $isAutoTrim = false)
    {
        parent::__construct($livrRules, $isAutoTrim);

        $this->registerRules(self::$extraRules);
    }
}
