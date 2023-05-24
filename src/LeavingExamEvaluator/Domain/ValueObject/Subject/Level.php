<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use School\Scalar\ValueObject\Enum\Enum;

class Level extends Enum
{
    /**
     * @var string
     */
    const ADVANCED = 'advanced';

    /**
     * @var string
     */
    const INTERMEDIATE = 'intermediate';

    protected static $enabledValues = [
        self::ADVANCED,
        self::INTERMEDIATE,
    ];
}
