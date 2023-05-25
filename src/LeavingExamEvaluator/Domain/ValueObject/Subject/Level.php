<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use School\Scalar\ValueObject\Enum\Enum;

class Level extends Enum
{
    /**
     * @var string
     */
    public const ADVANCED = 'advanced';

    /**
     * @var string
     */
    public const INTERMEDIATE = 'intermediate';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::ADVANCED,
        self::INTERMEDIATE,
    ];
}
