<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

class GetExtraScoreService
{
    /**
     * @throws IntegerOutOfRangeException
     */
    public function get(Tender $tender): UnsignedInteger
    {
        $extraScore = 0;

        /* @var Tender\GraduationResult $graduationResult */
        foreach ($tender->getGraduationResultCollection() as $graduationResult) {
            if ($graduationResult->getResult()->getValue() < 20) {
                continue;
            }

            if ($graduationResult->getLevel()->getValue() === Level::ADVANCED) {
                $extraScore += 50;
            }
        }

        $languageExams = $this->getCleanedLanguageExams($tender);

        foreach ($languageExams as $languageExam) {
            if ($extraScore < 100) {
                $extraScore += $languageExam->getScore()->getValue();
            }
        }

        return new UnsignedInteger(min($extraScore, 100));
    }

    /**
     * @param Tender $tender
     *
     * @return Tender\LanguageExam[]
     */
    private function getCleanedLanguageExams(Tender $tender): array
    {
        $languageExams = [];

        /* @var Tender\LanguageExam $languageExam */
        foreach ($tender->getLanguageExamCollection()->toArray() as $languageExam) {
            // The higher level exam must be used
            if (
                !isset($languageExams[$languageExam->getLanguage()->getValue()])
                || $languageExams[$languageExam->getLanguage()->getValue()]->compare($languageExam->getLevel()) === 1
            ) {
                $languageExams[$languageExam->getLanguage()->getValue()] = $languageExam;
            }
        }

        return $languageExams;
    }
}
