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
use DateInterval;

#[WorkflowInterface]
class TestWorkflow
{
    private Activity|ActivityProxy $activity;

    private bool $finalStatus = false;
    private bool $received = false;

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
        while (!$this->finalStatus) {
            yield Workflow::awaitWithTimeout(
                DateInterval::createFromDateString('1 minute'),
                fn() => $this->received
            );

            $this->received = false;
            $this->finalStatus = yield $this->activity->execute();
        }
    }
}
