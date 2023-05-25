<?php

namespace School\LeavingExamEvaluator\Domain\Collection;

use PHPUnit\Framework\TestCase;
use School\LeavingExamEvaluator\Domain\ValueObject\Subject\Level;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\Exception\InvalidCollectionItemException;

class LevelCollectionTest extends TestCase
{
    /**
     * @param LevelCollection $collection
     * @param array           $expected
     *
     * @dataProvider providerForTestConstruction
     */
    public function testConstruction(LevelCollection $collection, array $expected)
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
            new Level(Level::ADVANCED),
        ];
        $levelCollection = new LevelCollection($array);

        return [
            [
                'collection'    => $levelCollection,
                'expectedArray' => $array,
            ]
        ];
    }
}
