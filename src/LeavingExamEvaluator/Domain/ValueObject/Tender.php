<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject;

use School\LeavingExamEvaluator\Domain\Collection\GraduationResultCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\TenderStudy;

class Tender
{
    /**
     * @param TenderStudy                $tenderStudy
     * @param GraduationResultCollection $graduationResultCollection
     */
    public function __construct(
        private readonly TenderStudy $tenderStudy,
        private readonly GraduationResultCollection $graduationResultCollection,
    ) { }

    /**
     * @return TenderStudy
     */
    public function getTenderStudy(): TenderStudy
    {
        return $this->tenderStudy;
    }

    /**
     * @return GraduationResultCollection
     */
    public function getGraduationResultCollection(): GraduationResultCollection
    {
        return $this->graduationResultCollection;
    }
}
