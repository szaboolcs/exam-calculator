<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\TenderSubject;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\Scalar\Exception\InvalidCollectionItemException;

class TenderSubjectCollectionTest extends TestCase
{
    /**
     * @param TenderSubjectCollection $collection
     * @param array           $expected
     *
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(TenderSubjectCollection $collection, array $expected)
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
        $array                   = [
            new TenderSubject(
                new Subject(Subject::MATEMATKA),
                new LevelCollection([
                    new Level(Level::INTERMEDIATE),
                ]),
            ),
        ];
        $tenderSubjectCollection = new TenderSubjectCollection($array);

        return [
            [
                'collection'    => $tenderSubjectCollection,
                'expectedArray' => $array,
            ]
        ];
    }
}
