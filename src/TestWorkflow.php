<?php

declare(strict_types=1);

namespace App;

use Temporal\Workflow\WorkflowInterface;
use Temporal\Workflow\WorkflowMethod;
use Temporal\Activity\ActivityOptions;
use Carbon\CarbonInterval;
use Temporal\Common\RetryOptions;
use Temporal\Internal\Workflow\ActivityProxy;
use Temporal\Workflow;

#[WorkflowInterface]
class TestWorkflow
{
    private Activity|ActivityProxy $activity;

    public function __construct()
    {
        $this->activity = Workflow::newActivityStub(
            Activity::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::minute())
                ->withRetryOptions(RetryOptions::new()->withMaximumAttempts(1))
        );
    }

    #[WorkflowMethod]
    public function start(): iterable
    {
        yield $this->activity->execute(
            new Example(
                Enum::TEST,
                new ObjectA(
                    [
                        'key' => 'xxxxx'
                    ],
                    'dasdasdasdasdasdasdasdasdasdasdasdsadsadasdasdasdasdasdasdasd'
                )
            )
        );
    }
}
