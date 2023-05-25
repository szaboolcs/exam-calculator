<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use School\LeavingExamEvaluator\Application\Exception\NotAcceptableTenderException;
use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;

class GetMandatoryGraduationResultService
{
    /**
     * @param Tender $tender
     * @param Study  $study
     *
     * @return Tender\GraduationResult|null
     * @throws NotAcceptableTenderException
     */
    public function get(Tender $tender, Study $study): Tender\GraduationResult|null
    {
        $mandatoryLevels = array_map(function ($item) {
            return $item->getValue();
        }, $study->getMandatorySubject()->getLevelCollection()->toArray());

        foreach ($tender->getGraduationResultCollection() as $graduationResult) {
            if (
                $graduationResult->getSubject()->getValue() === $study->getMandatorySubject()->getSubject()->getValue()
                && in_array($graduationResult->getLevel()->getValue(), $mandatoryLevels)
            ) {
                return $graduationResult;
            }
        }

        return null;
    }
}
