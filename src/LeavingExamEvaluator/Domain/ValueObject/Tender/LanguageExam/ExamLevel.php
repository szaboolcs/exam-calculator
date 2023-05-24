<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;

use School\Scalar\ValueObject\Enum\Enum;

class ExamLevel extends Enum
{
    const A1 = 'a1';

    const A2 = 'a2';

    const B1 = 'b1';

    const B2 = 'b2';

    const C1 = 'c1';

    const C2 = 'c2';

    protected static $enabledValues = [
        self::A1,
        self::A2,
        self::B1,
        self::B2,
        self::C1,
        self::C2,
    ];
}
