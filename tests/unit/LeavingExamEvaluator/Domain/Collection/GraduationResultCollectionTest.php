<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Subject;
use School\LeavingExamEvaluator\Domain\ValueObject\Tender\GraduationResult;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\Exception\InvalidCollectionItemException;
use School\Scalar\ValueObject\Numeric\Percent;

class GraduationResultCollectionTest extends TestCase
{
    /**
     * @param GraduationResultCollection $collection
     * @param array                      $expected
     *
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(GraduationResultCollection $collection, array $expected)
    {
        $this->assertSame($expected, $collection->toArray());
    }

    /**
     * @return array[]
     *
     * @throws IntegerOutOfRangeException
     * @throws InvalidCollectionItemException
     */
    public static function providerForTestConstruction(): array
    {
        $subject          = new Subject(Subject::TORTENELEM);
        $level            = new Level(Level::ADVANCED);
        $result           = new Percent(70);
        $graduationResult = new GraduationResult($subject, $level, $result);

        $array                      = [
            $graduationResult
        ];
        $graduationResultCollection = new GraduationResultCollection($array);

        return [
            [
                'collection'    => $graduationResultCollection,
                'expectedArray' => $array,
            ]
        ];
    }
}
