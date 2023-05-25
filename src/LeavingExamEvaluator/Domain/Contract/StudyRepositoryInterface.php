<?php

namespace School\LeavingExamEvaluator\Domain\Contract;

use School\LeavingExamEvaluator\Domain\Collection\UniversityCollection;

interface StudyRepositoryInterface
{
    public function getAllStudy(): array;
}
