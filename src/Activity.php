<?php

declare(strict_types=1);

namespace App;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface(prefix: 'Workflow.')]
final class Activity
{
    #[ActivityMethod]
    public function execute(): bool
    {
        return true;
    }
}
