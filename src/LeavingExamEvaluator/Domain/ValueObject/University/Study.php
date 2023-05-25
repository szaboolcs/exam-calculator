<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\University;

use School\Scalar\ValueObject\Enum\Enum;

class Study extends Enum
{
    /**
     * @var string
     */
    public const PROGRAMTERVEZO_INFORMATIKUS = 'programtervezo_informatikus';

    /**
     * @var string
     */
    public const ANGLISZTIKA = 'anglisztika';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::PROGRAMTERVEZO_INFORMATIKUS,
        self::ANGLISZTIKA,
    ];
}
