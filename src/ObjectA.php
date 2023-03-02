<?php

declare(strict_types=1);

namespace App;

use Temporal\Internal\Marshaller\Type\ObjectType;
use Temporal\Internal\Marshaller\Meta\Marshal;
use Temporal\Internal\Marshaller\Meta\MarshalArray;

class ObjectA
{
    public function __construct(
        #[Marshal('objectB', ObjectType::class, ObjectB::class)]
        private ObjectB $objectB,
        #[Marshal('ObjectC', ObjectType::class, ObjectC::class)]
        private ObjectC $objectC,
        #[MarshalArray]
        private array $test
    ) {

    }

    public function getObjectB(): ObjectB
    {
        return $this->objectB;
    }

    public function getObjectC(): ObjectC
    {
        return $this->objectC;
    }

    public function getTest(): array
    {
        return $this->test;
    }


}
