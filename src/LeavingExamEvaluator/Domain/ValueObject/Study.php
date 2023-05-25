<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject;

use School\LeavingExamEvaluator\Domain\Collection\TenderSubjectCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study as StudyValueObject;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;

class Study
{
    /**
     * @param University              $university
     * @param Faculty                 $faculty
     * @param StudyValueObject        $study
     * @param TenderSubject           $mandatorySubject
     * @param TenderSubjectCollection $optionalSubjectCollection
     */
    public function __construct(
        private readonly University $university,
        private readonly Faculty $faculty,
        private readonly StudyValueObject $study,
        private readonly TenderSubject $mandatorySubject,
        private readonly TenderSubjectCollection $optionalSubjectCollection,
    ) {
    }

    /**
     * @return University
     */
    public function getUniversity(): University
    {
        return $this->university;
    }

    /**
     * @return Faculty
     */
    public function getFaculty(): Faculty
    {
        return $this->faculty;
    }

    /**
     * @return StudyValueObject
     */
    public function getStudy(): StudyValueObject
    {
        return $this->study;
    }

    /**
     * @return TenderSubject
     */
    public function getMandatorySubject(): TenderSubject
    {
        return $this->mandatorySubject;
    }

    /**
     * @return TenderSubjectCollection
     */
    public function getOptionalSubjectCollection(): TenderSubjectCollection
    {
        return $this->optionalSubjectCollection;
    }
}
