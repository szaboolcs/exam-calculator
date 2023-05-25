<?php

namespace School\LeavingExamEvaluator\Infrastructure\Persistence\Factory;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\Collection\LevelCollection;
use School\LeavingExamEvaluator\Domain\Collection\TenderSubjectCollection;
use School\LeavingExamEvaluator\Domain\ValueObject\Study as StudyValueObject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;
use School\Scalar\Exception\InvalidCollectionItemException;

class StudyFactoryTest extends TestCase
{
    /**
     * @dataProvider providerForTestCreate
     */
    public function testCreate(array $data, StudyValueObject $expected)
    {
        $studyFactory = new StudyFactory();
        $study        = $studyFactory->create($data);

        $this->assertEquals($expected, $study);
    }

    /**
     * @return array[]
     * @throws InvalidCollectionItemException
     */
    public static function providerForTestCreate(): array
    {
        return [
            [
                'data' => [
                    'university' => University::ELTE,
                    'faculty' => Faculty::IK,
                    'study' => Study::PROGRAMTERVEZO_INFORMATIKUS,
                    'mandatorySubject' => [
                        'subject' => Subject::MATEMATKA,
                        'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                    ],
                    'optionalSubjects' => [
                        [
                            'subject' => Subject::BIOLOGIA,
                            'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                        ],
                        [
                            'subject' => Subject::FIZIKA,
                            'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                        ],
                        [
                            'subject' => Subject::INFORMATIKA,
                            'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                        ],
                        [
                            'subject' => Subject::KEMIA,
                            'level'   => [Level::INTERMEDIATE, Level::ADVANCED],
                        ]
                    ],
                ],
                'study' => new StudyValueObject(
                    new University(University::ELTE),
                    new Faculty(Faculty::IK),
                    new Study(Study::PROGRAMTERVEZO_INFORMATIKUS),
                    new TenderSubject(
                        new Subject(Subject::MATEMATKA),
                        new LevelCollection([
                            new Level(Level::INTERMEDIATE),
                            new Level(Level::ADVANCED),
                        ]),
                    ),
                    new TenderSubjectCollection([
                        new TenderSubject(
                            new Subject(Subject::BIOLOGIA),
                            new LevelCollection([
                                new Level(Level::INTERMEDIATE),
                                new Level(Level::ADVANCED),
                            ]),
                        ),
                        new TenderSubject(
                            new Subject(Subject::FIZIKA),
                            new LevelCollection([
                                new Level(Level::INTERMEDIATE),
                                new Level(Level::ADVANCED),
                            ]),
                        ),
                        new TenderSubject(
                            new Subject(Subject::INFORMATIKA),
                            new LevelCollection([
                                new Level(Level::INTERMEDIATE),
                                new Level(Level::ADVANCED),
                            ]),
                        ),
                        new TenderSubject(
                            new Subject(Subject::KEMIA),
                            new LevelCollection([
                                new Level(Level::INTERMEDIATE),
                                new Level(Level::ADVANCED),
                            ]),
                        ),
                    ])
                ),
            ],
        ];
    }
}