<?php

declare(strict_types=1);

namespace App;

use Temporal\Internal\Marshaller\Meta\Marshal;

class ObjectD
{
    public function __construct(
        #[Marshal(nullable: true)]
    private ?string $xxx
    )
    {

    }

    public function getXxx(): ?string
    {
        return $this->xxx;
    }


}
