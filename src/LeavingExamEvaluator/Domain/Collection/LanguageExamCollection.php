<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use School\LeavingExamEvaluator\Domain\Contract\ScoreInterface;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;
use School\Scalar\Collection\Collection;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

class LanguageExamCollection extends Collection implements ScoreInterface
{
    /**
     * @var string
     */
    protected $type = LanguageExam::class;

    public function getScore(): UnsignedInteger
    {
        $score = 0;

        /* @var LanguageExam $languageExam */
        foreach ($this->toArray() as $languageExam) {
            $score += $languageExam->getScore()->getValue();
        }

        return new UnsignedInteger($score);
    }
}
