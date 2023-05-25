<?php

namespace School\LeavingExamEvaluator\Application\Service;

use School\LeavingExamEvaluator\Domain\Service\CalculatePointsService;
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

class LeavingExamEvaluatorService
{
    public function calculatePoints(Tender $tender)
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

    private function getDataMapper()
    {
        $studyRepository = new StudyRepository();
        $studyFactory = new StudyFactory();


        return new StudyMapper($studyRepository, $studyFactory);
    }
}
