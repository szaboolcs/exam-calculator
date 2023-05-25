<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use School\LeavingExamEvaluator\Domain\Contract\ScoreInterface;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\GraduationResult;
use School\Scalar\Collection\Collection;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

class GraduationResultCollection extends Collection implements ScoreInterface
{
    /**
     * @var string
     */
    protected $type = GraduationResult::class;

    public function getScore(): UnsignedInteger
    {
        $score = 0;

        /* @var GraduationResult $graduationResult */
        foreach ($this->toArray() as $graduationResult) {
            $score += $graduationResult->getScore()->getValue();
        }

        return new UnsignedInteger($score);
    }

    public function getExtraScore(): UnsignedInteger
    {
        $score = 0;

        /* @var GraduationResult $graduationResult */
        foreach ($this->toArray() as $graduationResult) {
            if ($graduationResult->getLevel()->getValue() === Level::ADVANCED) {
                $score += 50;
            }
        }

        return new UnsignedInteger($score);
    }
}
