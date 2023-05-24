<?php

namespace School\Scalar\Collection;

use PHPUnit\Framework\TestCase;
use School\Scalar\Exception\IntegerOutOfRangeException;
use School\Scalar\Exception\InvalidCollectionItemException;
use School\Scalar\ValueObject\Numeric\UnsignedInteger;
use School\Scalar\ValueObject\String\StringLiteral;

class TestStringLiteralCollection extends Collection
{
    protected $type = StringLiteral::class;
}

class CollectionTest extends TestCase
{
    public function testConstruction()
    {
        $testCollection = new TestStringLiteralCollection();

        $this->assertInstanceOf(Collection::class, $testCollection);
    }

    /**
     * @throws InvalidCollectionItemException
     */
    public function testClear()
    {
        $items = [
            new StringLiteral('Test'),
        ];

        $testCollection = new TestStringLiteralCollection($items);

        $testCollection->clear();

        $this->assertEmpty($testCollection->toArray());
    }

    /**
     * @throws InvalidCollectionItemException
     */
    public function testCopy()
    {
        $items = [
            new StringLiteral('Test'),
        ];

        $testCollection = new TestStringLiteralCollection($items);

        $copiedCollection = $testCollection->copy();

        $this->assertEquals($testCollection, $copiedCollection);
        $this->assertNotSame($testCollection, $copiedCollection);
    }

    public function testIsEmpty()
    {
        $testCollection = new TestStringLiteralCollection();

        $this->assertTrue($testCollection->isEmpty());
    }

    /**
     * @throws InvalidCollectionItemException
     */
    public function testToArray()
    {
        $items = [
            new StringLiteral('Test'),
        ];

        $testCollection = new TestStringLiteralCollection($items);

        $this->assertEquals($items, $testCollection->toArray());
    }

    /**
     * @throws InvalidCollectionItemException
     */
    public function testGetIterator()
    {
        $items = [
            new StringLiteral('Test'),
        ];

        $testCollection = new TestStringLiteralCollection($items);

        foreach ($testCollection as $index => $item) {
            $this->assertEquals($item, $items[$index]);
        }
    }

    /**
     * @throws InvalidCollectionItemException
     */
    public function testCount()
    {
        $items = [
            new StringLiteral('Test'),
        ];

        $testCollection = new TestStringLiteralCollection($items);

        $this->assertEquals(count($items), $testCollection->count());
    }

    /**
     * @throws InvalidCollectionItemException
     */
    public function testJsonSerialize()
    {
        $items = [
            new StringLiteral('Test'),
        ];

        $testCollection = new TestStringLiteralCollection($items);

        $this->assertEquals(json_encode($items), json_encode($testCollection));
    }

    /**
     * @throws InvalidCollectionItemException
     */
    public function testAdd()
    {
        $existingItem = new StringLiteral('Test');
        $newItem      = new StringLiteral('New Item');

        $testCollection = new TestStringLiteralCollection([$existingItem]);
        $testCollection->add($newItem);

        $this->assertEquals([$existingItem, $newItem], $testCollection->toArray());
    }

    /**
     * @throws IntegerOutOfRangeException
     */
    public function testAddForInvalidType()
    {
        $this->expectException(InvalidCollectionItemException::class);
        $invalidItem = new UnsignedInteger(1);

        $testCollection = new TestStringLiteralCollection();
        $testCollection->add($invalidItem);
    }

    /**
     * @throws InvalidCollectionItemException
     */
    public function testAddAll()
    {
        $newItem1 = new StringLiteral('New Item 1');
        $newItem2 = new StringLiteral('New Item 2');

        $testCollection = new TestStringLiteralCollection();
        $testCollection->addAll([$newItem1, $newItem2]);

        $this->assertEquals([$newItem1, $newItem2], $testCollection->toArray());
    }
}
