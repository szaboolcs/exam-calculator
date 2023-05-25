<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use School\LeavingExamEvaluator\Application\Exception\NotAcceptableTenderException;
use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

class GetScoreService
{
    /**
     * @param GetBaseScoreService  $getBaseScoreService
     * @param GetExtraScoreService $getExtraScoreService
     */
    public function __construct(
        private readonly GetBaseScoreService $getBaseScoreService,
        private readonly GetExtraScoreService $getExtraScoreService,
    ) {
    }

    /**
     * @throws IntegerOutOfRangeException
     * @throws NotAcceptableTenderException
     */
    public function get(Tender $tender, Study $study): UnsignedInteger
    {
        $baseScore = $this->getBaseScoreService->get($tender, $study);
        $extraScore = $this->getExtraScoreService->get($tender);

        $score = $baseScore->getValue() + $extraScore->getValue();

        return new UnsignedInteger($score);
    }
}
