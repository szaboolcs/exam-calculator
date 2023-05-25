<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender;

use School\LeavingExamEvaluator\Domain\Contract\ScoreInterface;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\ValueObject\Numeric\Percent;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

class GraduationResult implements ScoreInterface
{
    /**
     * @param Subject $subject
     * @param Level   $level
     * @param Percent $result
     */
    public function __construct(
        private readonly Subject $subject,
        private readonly Level $level,
        private readonly Percent $result,
    ) {
    }

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

    /**
     * @return UnsignedInteger
     * @throws IntegerOutOfRangeException
     */
    public function getScore(): UnsignedInteger
    {
        return new UnsignedInteger($this->result->getValue());
    }
}
