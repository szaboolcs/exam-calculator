<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use School\Scalar\ValueObject\Enum\Enum;

class Type extends Enum
{
    /**
     * @var string
     */
    const MANDATORY = 'mandatory';

    /**
     * @var string
     */
    const OPTIONAL = 'optional';

    protected static $enabledValues = [
        self::MANDATORY,
        self::OPTIONAL,
    ];
}
