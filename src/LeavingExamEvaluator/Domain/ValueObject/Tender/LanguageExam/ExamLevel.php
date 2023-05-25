<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;

use School\Scalar\ValueObject\Enum\Enum;

class ExamLevel extends Enum
{
    /**
     * @var string
     */
    public const B2 = 'b2';

    /**
     * @var string
     */
    public const C1 = 'c1';

    /**
     * @var string[]
     */
    protected static $enabledValues = [
        self::B2,
        self::C1,
    ];

    /**
     * @return string[]
     */
    private static function getAllOrderByDescendingLevel(): array
    {
        return [
            self::C1,
            self::B2,
        ];
    }

    /**
     * @param ExamLevel $level
     *
     * @return bool
     */
    public function compare(ExamLevel $level): bool
    {
        if ($this->getValue() === $level->getValue()) {
            return 0;
        }

        $arrayOrderByDescendingLevel = self::getAllOrderByDescendingLevel();


        $key1 = array_search($this->value, $arrayOrderByDescendingLevel);
        $key2 = array_search($level->getValue(), $arrayOrderByDescendingLevel);

        if ($key2 > $key1) {
            return 1;
        }

        return -1;
    }
}
