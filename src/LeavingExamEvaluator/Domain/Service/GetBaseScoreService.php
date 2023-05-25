<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use School\LeavingExamEvaluator\Application\Exception\NotAcceptableTenderException;
use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

class GetBaseScoreService
{
    /**
     * @param GetMandatoryGraduationResultService    $getMandatoryGraduationResultService
     * @param GetBestOptionalGraduationResultService $getBestOptionalGraduationResultService
     */
    public function __construct(
        private readonly GetMandatoryGraduationResultService $getMandatoryGraduationResultService,
        private readonly GetBestOptionalGraduationResultService $getBestOptionalGraduationResultService,
    ) {
    }

    /**
     * @throws IntegerOutOfRangeException
     * @throws NotAcceptableTenderException
     */
    public function get(Tender $tender, Study $study): UnsignedInteger
    {
        $optionalGraduationResult = $this->getBestOptionalGraduationResultService->get($tender, $study);
        $mandatoryGraduationResult = $this->getMandatoryGraduationResultService->get($tender, $study);


        return new UnsignedInteger((
            $mandatoryGraduationResult->getScore()->getValue() + $optionalGraduationResult->getScore()->getValue()
        ) * 2);
    }
}
