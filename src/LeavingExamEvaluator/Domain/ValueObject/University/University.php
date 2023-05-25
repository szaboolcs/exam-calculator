<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\University;

use School\Scalar\ValueObject\Enum\Enum;

class University extends Enum
{
    /**
     * @var string
     */
    public const ELTE = 'elte';

    /**
     * @var string
     */
    public const PPKE = 'ppke';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::ELTE,
        self::PPKE,
    ];
}
