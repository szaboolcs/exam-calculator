<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\Scalar\Collection\Collection;

class LevelCollection extends Collection
{
    /**
     * @var string
     */
    protected $type = Level::class;
}
