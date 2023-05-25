<?php

namespace School\LeavingExamEvaluator\Domain\Contract;

use School\Scalar\ValueObject\Numeric\UnsignedInteger;

interface ScoreInterface
{
    public function getScore(): UnsignedInteger;
}
