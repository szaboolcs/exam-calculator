<?php

namespace School\Scalar\Collection;

use School\Scalar\Exception\InvalidCollectionItemException;

abstract class Collection extends AbstractCollection
{
    /**
     * @param mixed $item
     *
     * @throws InvalidCollectionItemException
     */
    public function add($item)
    {
        $this->isValidType($item);
        $this->items[] = $item;
    }

    /**
     * @param array $items
     *
     * @throws InvalidCollectionItemException
     */
    public function addAll(array $items)
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }
}
