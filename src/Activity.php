<?php

declare(strict_types=1);

namespace App;

use Temporal\Activity\ActivityInterface;
use Temporal\Activity\ActivityMethod;

#[ActivityInterface(prefix: 'Workflow.')]
final class Activity
{
    #[ActivityMethod]
    public function execute(Example $example): Example
    {
        return new Example(
            new ObjectA(
                [
                    'test' => 'dsada',
                    'test1' => 'dsada',
                    'test2' => 'dsada',
                    'test3' => 'dsada',
                ],
                'dasdsadsadsd'
            )
        );
    }
}
