<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender;

use School\LeavingExamEvaluator\Domain\Contract\ScoreInterface;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\ExamLevel;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\Language;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

class LanguageExam implements ScoreInterface
{
    /**
     * @param Language  $language
     * @param ExamLevel $level
     */
    public function __construct(
        private readonly Language $language,
        private readonly ExamLevel $level,
    ) {
    }

    /**
     * @return Language
     */
    public function getLanguage(): Language
    {
        return $this->language;
    }

    /**
     * @return ExamLevel
     */
    public function getLevel(): ExamLevel
    {
        return $this->level;
    }

    /**
     * @return UnsignedInteger
     * @throws IntegerOutOfRangeException
     */
    public function getScore(): UnsignedInteger
    {
        switch ($this->level->getValue()) {
            case ExamLevel::B2:
                return new UnsignedInteger(28);

            case ExamLevel::C1:
                return new UnsignedInteger(40);
        }
    }
}
