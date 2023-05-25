<?php

namespace School\LeavingExamEvaluator\Domain\ValueObject\Subject;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\Collection\LevelCollection;

class TenderSubjectTest extends TestCase
{
    /**
     * @param TenderSubject   $tenderSubject
     * @param Subject         $subject
     * @param LevelCollection $levelCollection
     *
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(TenderSubject $tenderSubject, Subject $subject, LevelCollection $levelCollection)
    {
        $this->assertSame($subject, $tenderSubject->getSubject());
        $this->assertSame($levelCollection, $tenderSubject->getLevelCollection());
    }

    public static function providerForTestConstruction()
    {
        $subject         = new Subject(Subject::ANGOL);
        $level           =  new Level(Level::ADVANCED);
        $levelCollection = new LevelCollection([$level]);
        $tenderSubject   = new TenderSubject($subject, $levelCollection);

        return [
            [
                'tenderSubject'   => $tenderSubject,
                'subject'         => $subject,
                'levelCollection' => $levelCollection
            ],
        ];
    }
}
