<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;

use School\Scalar\ValueObject\Enum\Enum;

class Language extends Enum
{
    /**
     * @var string
     */
    public const ANGOL = 'angol';

    /**
     * @var string
     */
    public const FRANCIA = 'francia';

    /**
     * @var string
     */
    public const NEMET = 'nemet';

    /**
     * @var string
     */
    public const OLASZ = 'olasz';

    /**
     * @var string
     */
    public const SPANYOL = 'spanyol';

    /**
     * @var string
     */
    public const OROSZ = 'orosz';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::ANGOL,
        self::FRANCIA,
        self::NEMET,
        self::OLASZ,
        self::SPANYOL,
        self::OROSZ
    ];
}
