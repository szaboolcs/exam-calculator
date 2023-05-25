<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\Scalar\Collection\Collection;

class StudyCollection extends Collection
{
    /**
     * @var string
     */
    protected $type = Study::class;
}
