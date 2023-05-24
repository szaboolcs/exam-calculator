<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Tender;

use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;

class TenderStudy
{
    public function __construct(
        private readonly University $university,
        private readonly Faculty $faculty,
        private readonly Study $study,
    ) {}

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
     * @return Study
     */
    public function getStudy(): Study
    {
        return $this->study;
    }
}
