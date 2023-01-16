<?php

declare(strict_types=1);

namespace App;

use Temporal\Internal\Marshaller\Meta\Marshal;

class ObjectA
{
    public function __construct(
        #[Marshal]
        private array $array = [],
        #[Marshal]
        private ?string $string = null
    ) {
    }
}
