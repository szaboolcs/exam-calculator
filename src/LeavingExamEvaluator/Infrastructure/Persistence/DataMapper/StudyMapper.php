<?php

namespace School\LeavingExamEvaluator\Infrastructure\Persistence\DataMapper;

use School\LeavingExamEvaluator\Domain\Contract\StudyRepositoryInterface;
use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender;
use School\LeavingExamEvaluator\Infrastructure\Persistence\Factory\StudyFactory;
use School\Scalar\Exception\InvalidCollectionItemException;
use School\Scalar\Exception\InvalidEnumValueException;

class StudyMapper
{
    /**
     * @param StudyRepositoryInterface $studyRepository
     * @param StudyFactory             $studyFactory
     */
    public function __construct(
        private readonly StudyRepositoryInterface $studyRepository,
        private readonly StudyFactory $studyFactory
    ) {
    }

    /**
     * @param Tender $tender
     *
     * @return Study|null
     * @throws InvalidCollectionItemException
     * @throws InvalidEnumValueException
     */
    public function findByTender(Tender $tender): Study|null
    {
        $studies = $this->studyRepository->getAllStudy();

        foreach ($studies as $study) {
            if (
                $study['university'] === $tender->getTenderStudy()->getUniversity()->getValue()
                && $study['faculty'] === $tender->getTenderStudy()->getFaculty()->getValue()
                && $study['study'] === $tender->getTenderStudy()->getStudy()->getValue()
            ) {
                return $this->studyFactory->create($study);
            }
        }

        return null;
    }
}
