<?php

use App\TestWorkflow;
use Temporal\Client\WorkflowClient;
use Temporal\Client\GRPC\ServiceClient;
use App\ObjectA;
use App\ObjectB;
use App\ObjectC;
use App\ObjectD;

require './vendor/autoload.php';

$workflowClient = WorkflowClient::create(ServiceClient::create('temporal:7233'));


$workflow = $workflowClient->newWorkflowStub(
    TestWorkflow::class
);

$test = new ObjectA(
    new ObjectB('2132', 'asdasd', null),
    new ObjectC(new ObjectD('d'), [1,2,3,3,4,5,5,6], 'asdsad'),
    [
        'dasdasd' => 'asdasd',
        'sdasd'
    ]

);

$workflowClient->start($workflow, $test);

if ($value = random_int(0, 1)) {
    $workflow->setStatus((bool) $value);
}
