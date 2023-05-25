<?php

namespace School\LeavingExamEvaluator\Application\Contract;

use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

interface LeavingExamEvaluatorServiceInterface
{
    /**
     * @param Tender $tender
     *
     * @return UnsignedInteger
     */
    public function getScore(Tender $tender): UnsignedInteger;
}
