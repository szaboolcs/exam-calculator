<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use School\LeavingExamEvaluator\Domain\ValueObject\Tender\LanguageExam;
use School\Scalar\Collection\Collection;

class LanguageExamCollection extends Collection
{
    /**
     * @var string
     */
    protected $type = LanguageExam::class;
}
