<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\University;

use School\Scalar\ValueObject\Enum\Enum;

class Faculty extends Enum
{
    /**
     * @var string
     */
    public const IK = 'IK';

    /**
     * @var string
     */
    public const BTK = 'BTK';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::IK,
        self::BTK,
    ];
}
