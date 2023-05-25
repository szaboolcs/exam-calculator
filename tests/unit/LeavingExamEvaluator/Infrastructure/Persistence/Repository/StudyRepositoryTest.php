<?php

namespace School\LeavingExamEvaluator\Infrastructure\Persistence\Repository;

use PHPUnit\Framework\TestCase;

class StudyRepositoryTest extends TestCase
{
    public function testGetAllStudy()
    {
        $this->assertEquals('array', gettype((new StudyRepository())->getAllStudy()));
    }
}
