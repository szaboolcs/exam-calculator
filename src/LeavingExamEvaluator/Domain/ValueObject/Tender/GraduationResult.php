<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender;

use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\Scalar\ValueObject\Numeric\Percent;

class GraduationResult
{
    public function __construct(
        private readonly Subject $subject,
        private readonly Level $level,
        private readonly Percent $result,
    ) { }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @return Level
     */
    public function getLevel(): Level
    {
        return $this->level;
    }

    /**
     * @return Percent
     */
    public function getResult(): Percent
    {
        return $this->result;
    }
}
