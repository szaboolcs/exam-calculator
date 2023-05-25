<?php

namespace School\LeavingExamEvaluator\Application\Service;

use School\LeavingExamEvaluator\Application\Contract\LeavingExamEvaluatorServiceInterface;
use School\LeavingExamEvaluator\Application\Exception\NotAcceptableTenderException;
use School\LeavingExamEvaluator\Application\Exception\StudyNotFoundException;
use School\LeavingExamEvaluator\Domain\Service\GetBaseScoreService;
use School\LeavingExamEvaluator\Domain\Service\GetBestOptionalGraduationResultService;
use School\LeavingExamEvaluator\Domain\Service\GetExtraScoreService;
use School\LeavingExamEvaluator\Domain\Service\GetMandatoryGraduationResultService;
use School\LeavingExamEvaluator\Domain\Service\GetScoreService;
use School\LeavingExamEvaluator\Domain\Service\GetStudyByTenderService;
use School\LeavingExamEvaluator\Domain\Service\ValidateTenderService;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\LeavingExamEvaluator\Infrastructure\Persistence\DataMapper\StudyMapper;
use School\LeavingExamEvaluator\Infrastructure\Persistence\Factory\StudyFactory;
use School\LeavingExamEvaluator\Infrastructure\Persistence\Repository\StudyRepository;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;

class LeavingExamEvaluatorService implements LeavingExamEvaluatorServiceInterface
{
    /**
     * @param Tender $tender
     *
     * @return UnsignedInteger
     *
     * @throws NotAcceptableTenderException
     * @throws StudyNotFoundException
     * @throws IntegerOutOfRangeException
     */
    public function getScore(Tender $tender): UnsignedInteger
    {
        $dataMapper              = $this->getDataMapper();
        $getStudyByTenderService = new GetStudyByTenderService($dataMapper);
        $study                   = $getStudyByTenderService->get($tender);

        $getBestOptionalGraduationResultService = new GetBestOptionalGraduationResultService();
        $getMandatoryGraduationResultService = new GetMandatoryGraduationResultService();

        $validateTenderService = new ValidateTenderService(
            $getBestOptionalGraduationResultService,
            $getMandatoryGraduationResultService
        );
        $validateTenderService->validate($tender, $study);

        $getBaseScoreService = new GetBaseScoreService(
            $getMandatoryGraduationResultService,
            $getBestOptionalGraduationResultService
        );
        $getExtraScoreService = new GetExtraScoreService();

        $getScoreService = new GetScoreService($getBaseScoreService, $getExtraScoreService);
        return $getScoreService->get($tender, $study);
    }

    /**
     * @return StudyMapper
     */
    private function getDataMapper(): StudyMapper
    {
        $studyRepository = new StudyRepository();
        $studyFactory    = new StudyFactory();

        return new StudyMapper($studyRepository, $studyFactory);
    }
}
