<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Contract\SubjectHumanInterface;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Contract\SubjectRealInterface;
use School\Scalar\ValueObject\Enum\Enum;

class Subject extends Enum implements SubjectHumanInterface, SubjectRealInterface
{
    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::MAGYAR_NYELV_ES_IRODALOM,
        self::MATEMATKA,
        self::BIOLOGIA,
        self::FIZIKA,
        self::INFORMATIKA,
        self::KEMIA,
        self::ANGOL,
        self::FRANCIA,
        self::NEMET,
        self::OLASZ,
        self::SPANYOL,
        self::OROSZ,
        self::TORTENELEM,
    ];

    /**
     * @return string
     */
    public function getHumanReadableName(): string
    {
        switch ($this->value) {
            case self::MAGYAR_NYELV_ES_IRODALOM:
                return 'Magyar nyelv és irodalom.';

            case self::MATEMATKA:
                return 'Matematika';

            case self::BIOLOGIA:
                return 'Biológia';

            case self::FIZIKA:
                return 'Fizika';

            case self::INFORMATIKA:
                return 'Informatika';

            case self::KEMIA:
                return 'Kémia';

            case self::ANGOL:
                return 'Angol';

            case self::FRANCIA:
                return 'Francia';

            case self::NEMET:
                return 'Német';

            case self::OLASZ:
                return 'Olasz';

            case self::SPANYOL:
                return 'Spanyol';

            case self::OROSZ:
                return 'Orosz';

            case self::TORTENELEM:
                return 'Történelem';
        }
    }
}
