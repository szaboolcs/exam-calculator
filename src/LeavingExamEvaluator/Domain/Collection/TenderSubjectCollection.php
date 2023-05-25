<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use School\LeavingExamEvaluator\Domain\Entity\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\Scalar\Collection\Collection;

class TenderSubjectCollection extends Collection
{
    /**
     * @var string
     */
    protected $type = TenderSubject::class;
}
