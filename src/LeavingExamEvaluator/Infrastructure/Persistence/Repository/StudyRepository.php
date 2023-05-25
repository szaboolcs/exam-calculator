<?php

namespace School\LeavingExamEvaluator\Infrastructure\Persistence\Repository;

use School\LeavingExamEvaluator\Domain\Contract\StudyRepositoryInterface;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Faculty;
use School\LeavingExamEvaluator\Domain\ValueObject\University\Study;
use School\LeavingExamEvaluator\Domain\ValueObject\University\University;

class StudyRepository implements StudyRepositoryInterface
{
    /**
     * @return array[]
     */
    public function getAllStudy(): array
    {
        return [
            [
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
            [
                'university' => University::PPKE,
                'faculty' => Faculty::BTK,
                'study' => Study::ANGLISZTIKA,
                'mandatorySubject' => [
                    'subject' => Subject::ANGOL,
                    'level'   => [Level::ADVANCED],
                ],
                'optionalSubjects' => [
                    [
                        'subject' => Subject::FRANCIA,
                        'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                    ],
                    [
                        'subject' => Subject::NEMET,
                        'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                    ],
                    [
                        'subject' => Subject::OLASZ,
                        'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                    ],
                    [
                        'subject' => Subject::OROSZ,
                        'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                    ],
                    [
                        'subject' => Subject::SPANYOL,
                        'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                    ],
                    [
                        'subject' => Subject::TORTENELEM,
                        'level'   => [Level::ADVANCED, Level::INTERMEDIATE],
                    ],
                ],
            ],
        ];
    }
}
