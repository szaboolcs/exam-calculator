<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\ValueObject\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study as StudyValueObject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\Scalar\Exception\InvalidCollectionItemException;

class StudyCollectionTest extends TestCase
{
    /**
     * @param StudyCollection $collection
     * @param array           $expected
     *
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(StudyCollection $collection, array $expected)
    {
        $this->assertSame($expected, $collection->toArray());
    }

    /**
     * @return array[]
     *
     * @throws InvalidCollectionItemException
     */
    public static function providerForTestConstruction(): array
    {
        $array           = [
            new Study(
                new University(University::PPKE),
                new Faculty(Faculty::BTK),
                new StudyValueObject(StudyValueObject::ANGLISZTIKA),
                new TenderSubject(
                    new Subject(Subject::TORTENELEM),
                    new LevelCollection([
                        new Level(Level::ADVANCED),
                    ]),
                ),
                new TenderSubjectCollection([
                    new TenderSubject(
                        new Subject(Subject::MATEMATKA),
                        new LevelCollection([
                            new Level(Level::INTERMEDIATE),
                        ]),
                    )
                ])
            ),
        ];
        $studyCollection = new StudyCollection($array);

        return [
            [
                'collection'    => $studyCollection,
                'expectedArray' => $array,
            ]
        ];
    }
}
