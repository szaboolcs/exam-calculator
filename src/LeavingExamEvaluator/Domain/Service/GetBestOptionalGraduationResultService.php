<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;

class GetBestOptionalGraduationResultService
{
    /**
     * @param Tender $tender
     * @param Study  $study
     *
     * @return Tender\GraduationResult|null
     */
    public function get(Tender $tender, Study $study): Tender\GraduationResult|null
    {
        $optionalGraduationResult = null;

        $optionalSubjects = array_map(function (TenderSubject $item) {
            return $item->getSubject()->getValue();
        }, $study->getOptionalSubjectCollection()->toArray());

        /* @var Tender\GraduationResult $graduationResult */
        foreach ($tender->getGraduationResultCollection() as $graduationResult) {
            if (!in_array($graduationResult->getSubject()->getValue(), $optionalSubjects)) {
                continue;
            }

            if (
                !$optionalGraduationResult
                || $optionalGraduationResult->getResult()->getValue() < $graduationResult->getResult()->getValue()
            ) {
                $optionalGraduationResult = $graduationResult;
            }
        }

        return $optionalGraduationResult;
    }
}
