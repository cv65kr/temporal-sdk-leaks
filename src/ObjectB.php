<?php

declare(strict_types=1);

namespace App;

use Temporal\Internal\Marshaller\Meta\Marshal;

class ObjectB
{
    public function __construct(
        #[Marshal(nullable: true)]
        private ?string $aa,
        #[Marshal(nullable: true)]
        private ?string $bb,
        #[Marshal(nullable: true)]
        private ?string $cc
    ) {

    }

    public function getAa(): ?string
    {
        return $this->aa;
    }

    public function getBb(): ?string
    {
        return $this->bb;
    }

    public function getCc(): ?string
    {
        return $this->cc;
    }


}
