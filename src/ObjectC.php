<?php

declare(strict_types=1);

namespace App;

use Temporal\Internal\Marshaller\Meta\Marshal;
use Temporal\Internal\Marshaller\Meta\MarshalArray;
use Temporal\Internal\Marshaller\Type\ObjectType;

class ObjectC
{
    public function __construct(
        #[Marshal('objectB', ObjectType::class, ObjectD::class)]
        private ObjectD $objectD,
        #[MarshalArray]
        private array $test,
        #[Marshal(nullable: true)]
        private ?string $xxx
    ) {

    }

    public function getObjectD(): ObjectD
    {
        return $this->objectD;
    }

    public function getTest(): array
    {
        return $this->test;
    }

    public function getXxx(): ?string
    {
        return $this->xxx;
    }
}
