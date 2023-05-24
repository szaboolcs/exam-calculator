<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender;

use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\ExamLevel;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam\Language;

class LanguageExam
{
    public function __construct(
        private readonly Language $language,
        private readonly ExamLevel $level,
    ) {}

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
}

