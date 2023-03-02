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
use Temporal\Exception\Failure\CanceledFailure;
use Temporal\Activity\ActivityCancellationType;

#[WorkflowInterface]
class TestWorkflow
{
    private Activity|ActivityProxy $greetingActivity;

    private bool $status = false;
    private bool $polledStatus = false;


    public function __construct()
    {
        $this->greetingActivity = Workflow::newActivityStub(
            Activity::class,
            ActivityOptions::new()
                ->withStartToCloseTimeout(CarbonInterval::minutes(3))
                ->withHeartbeatTimeout(CarbonInterval::minutes(3))
                ->withRetryOptions(RetryOptions::new()->withMaximumAttempts(0))
                ->withCancellationType(ActivityCancellationType::WAIT_CANCELLATION_COMPLETED)
        );
    }

    #[Workflow\SignalMethod]
    public function setStatus(bool $status): void
    {
        $this->status = $status;
    }

    #[WorkflowMethod]
    public function start(ObjectA $test): iterable
    {
        $pollingStatusScope = Workflow::async(
            function () use($test): iterable {
                $pollCount = 0;
                while (true) {
                    ++$pollCount;
                    $polledStatus = yield $this->greetingActivity->composeGreeting($test, $pollCount);
                    if ($polledStatus) {
                        $this->polledStatus = $polledStatus;
                        return;
                    }

                    yield Workflow::timer(
                        CarbonInterval::seconds(5)
                    );
                }
            }
        );

        Workflow::async(
            function () use ($pollingStatusScope): iterable {
                yield Workflow::await(fn () => false !== $this->status  || false !== $this->polledStatus);

                // To avoid race condition with cancelling
                yield Workflow::timer(CarbonInterval::seconds(3));


                // If the condition was successful the first coroutine is cancelled (we stop polling from activity)
                $pollingStatusScope->cancel();
            }
        );

        try {
            yield $pollingStatusScope;
        } catch (CanceledFailure $exception) {

        }

    }
}
