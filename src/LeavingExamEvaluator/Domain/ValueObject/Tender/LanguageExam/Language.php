<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;

use School\Scalar\ValueObject\Enum\Enum;

class Language extends Enum
{
    const ANGOL = 'angol';
    const FRANCIA = 'francia';
    const NEMET = 'nemet';
    const OLASZ = 'olasz';
    const SPANYOL = 'spanyol';
    const OROSZ = 'orosz';

    protected static $enabledValues = [
        self::ANGOL,
        self::FRANCIA,
        self::NEMET,
        self::OLASZ,
        self::SPANYOL,
        self::OROSZ
    ];
}
