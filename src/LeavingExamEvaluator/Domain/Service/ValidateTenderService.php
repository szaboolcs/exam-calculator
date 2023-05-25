<?php

namespace School\LeavingExamEvaluator\Domain\Service;

use School\LeavingExamEvaluator\Application\Exception\NotAcceptableTenderException;
use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;

class ValidateTenderService
{
    /**
     * @var array
     */
    private const MANDATORY_FINAL_EXAM_SUBJECTS = [
        Subject::MAGYAR_NYELV_ES_IRODALOM,
        Subject::TORTENELEM,
        Subject::MATEMATKA,
    ];

    /**
     * @param GetBestOptionalGraduationResultService $getBestOptionalGraduationResultService
     * @param GetMandatoryGraduationResultService    $getMandatoryGraduationResultService
     */
    public function __construct(
        private readonly GetBestOptionalGraduationResultService $getBestOptionalGraduationResultService,
        private readonly GetMandatoryGraduationResultService $getMandatoryGraduationResultService,
    ) {
    }


    /**
     * @throws NotAcceptableTenderException
     */
    public function validate(Tender $tender, Study $study): void
    {
        $this->validateMandatoryFinalExams($tender);
        $this->validateMandatorySubjectRequirements($tender, $study);
        $this->validateOptionalGraduationResultRequirements($tender, $study);
    }

    /**
     * @throws NotAcceptableTenderException
     */
    private function validateMandatoryFinalExams(Tender $tender): void
    {
        $subjects = [];

        /* @var Tender\GraduationResult $graduationResult */
        foreach ($tender->getGraduationResultCollection() as $graduationResult) {
            $subjects[$graduationResult->getSubject()->getValue()] = $graduationResult;
        }

        foreach (self::MANDATORY_FINAL_EXAM_SUBJECTS as $subject) {
            if (!isset($subjects[$subject])) {
                throw new NotAcceptableTenderException(
                    'Nem lehetséges a pontszámítás a kötelező érettséti tárgy hiánya miatt.'
                );
            }

            if ($subjects[$subject]->getResult()->getValue() < 20) {
                throw new NotAcceptableTenderException('Nem lehetséges a pontszámítás a '
                    . $subjects[$subject]->getSubject()->getHumanReadableName()
                    . ' tárgyból elért 20% alatti eredmény miatt.');
            }
        }
    }

    /**
     * @throws NotAcceptableTenderException
     */
    private function validateMandatorySubjectRequirements(Tender $tender, Study $study): void
    {
        $mandatoryGraduationResult = $this->getMandatoryGraduationResultService->get($tender, $study);

        if ($mandatoryGraduationResult === null || $mandatoryGraduationResult->getResult()->getValue() < 20) {
            throw new NotAcceptableTenderException('Nem lehetséges a pontszámítás, hiányzó kötelező tantárgy.');
        }
    }

    /**
     * @throws NotAcceptableTenderException
     */
    private function validateOptionalGraduationResultRequirements(Tender $tender, Study $study): void
    {
        $graduationResult = $this->getBestOptionalGraduationResultService->get($tender, $study);

        if ($graduationResult === null || $graduationResult->getResult()->getValue() < 20) {
            throw new NotAcceptableTenderException(
                'Nem lehetséges a pontszámítás, hiányzó kötelezően választandó tantárgy.'
            );
        }
    }
}
