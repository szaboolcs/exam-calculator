<?php

namespace School\LeavingExamEvaluator\Infrastructure\Persistence\Factory;

use School\LeavingExamEvaluator\Domain\Collection\LevelCollection;
use School\LeavingExamEvaluator\Domain\Collection\TenderSubjectCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study as StudyValueObject;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\Scalar\Exception\InvalidCollectionItemException;
use School\Scalar\Exception\InvalidEnumValueException;

class StudyFactory
{
    /**
     * @param array $data
     *
     * @return Study
     * @throws InvalidCollectionItemException
     * @throws InvalidEnumValueException
     */
    public function create(array $data)
    {
        $optionalSubjectCollection = new TenderSubjectCollection();

        foreach ($data['optionalSubjects'] as $optionalSubject) {
            $optionalSubjectCollection->add($this->createTenderSubject($optionalSubject));
        }

        return new Study(
            new University($data['university']),
            new Faculty($data['faculty']),
            new StudyValueObject($data['study']),
            $this->createTenderSubject($data['mandatorySubject']),
            $optionalSubjectCollection,
        );
    }

    /**
     * @param array $data
     *
     * @return TenderSubject
     * @throws InvalidCollectionItemException
     * @throws InvalidEnumValueException
     */
    private function createTenderSubject(array $data): TenderSubject
    {
        return new TenderSubject(
            new Subject($data['subject']),
            new LevelCollection(
                array_map(function (string $item) {
                    return new Level($item);
                }, $data['level'])
            ),
        );
    }
}
