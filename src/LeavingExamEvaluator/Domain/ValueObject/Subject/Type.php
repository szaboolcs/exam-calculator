<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use School\Scalar\ValueObject\Enum\Enum;

class Type extends Enum
{
    /**
     * @var string
     */
    public const MANDATORY = 'mandatory';

    /**
     * @var string
     */
    public const OPTIONAL = 'optional';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::MANDATORY,
        self::OPTIONAL,
    ];
}
