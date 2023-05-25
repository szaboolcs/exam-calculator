<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use School\LeavingExamEvaluator\Application\Exception\StudyNotFoundException;
use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\LeavingExamEvaluator\Infrastructure\Persistence\DataMapper\StudyMapper;

class GetStudyByTenderService
{
    /**
     * @param StudyMapper $studyMapper
     */
    public function __construct(private readonly StudyMapper $studyMapper)
    {
    }

    /**
     * @param Tender $tender
     *
     * @return Study
     * @throws StudyNotFoundException
     */
    public function get(Tender $tender): Study
    {
        $study = $this->studyMapper->findByTender($tender);

        if ($study === null) {
            throw new StudyNotFoundException('The study is not found for the given tender.');
        }

        return $study;
    }
}
