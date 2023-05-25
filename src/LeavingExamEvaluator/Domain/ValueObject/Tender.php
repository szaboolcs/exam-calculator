<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject;

use School\LeavingExamEvaluator\Domain\Collection\GraduationResultCollection;
use School\LeavingExamEvaluator\Domain\Collection\LanguageExamCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\TenderStudy;

class Tender
{
    /**
     * @param TenderStudy                $tenderStudy
     * @param GraduationResultCollection $graduationResultCollection
     * @param LanguageExamCollection     $languageExamCollection
     */
    public function __construct(
        private readonly TenderStudy $tenderStudy,
        private readonly GraduationResultCollection $graduationResultCollection,
        private readonly LanguageExamCollection $languageExamCollection
    ) {
    }

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

    /**
     * @return LanguageExamCollection
     */
    public function getLanguageExamCollection(): LanguageExamCollection
    {
        return $this->languageExamCollection;
    }
}
