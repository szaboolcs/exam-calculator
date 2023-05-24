<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\University;

use School\Scalar\ValueObject\Enum\Enum;

class Study extends Enum
{
    const PROGRAMTERVEZO_INFORMATIKUS = 'programtervezo_informatikus';

    const ANGLISZTIKA = 'anglisztika';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::PROGRAMTERVEZO_INFORMATIKUS,
        self::ANGLISZTIKA,
    ];
}
