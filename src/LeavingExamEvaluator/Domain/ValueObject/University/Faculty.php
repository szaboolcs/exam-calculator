<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\University;

use School\Scalar\ValueObject\Enum\Enum;

class Faculty extends Enum
{
    const IK = 'IK';

    const BTK = 'BTK';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::IK,
        self::BTK,
    ];
}
