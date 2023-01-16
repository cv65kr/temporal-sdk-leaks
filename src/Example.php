<?php

declare(strict_types=1);

namespace App;

use Temporal\Internal\Marshaller\Meta\Marshal;
use Temporal\Internal\Marshaller\Type\ObjectType;
use Temporal\Internal\Marshaller\Type\NullableType;

class Example
{
    public function __construct(
        #[Marshal(type: ObjectType::class, of: ObjectA::class)]
        private ObjectA $test1,
        #[Marshal(type: NullableType::class, of: ObjectA::class)]
        private ?ObjectA $test2 = null
    ) {
    }
}
