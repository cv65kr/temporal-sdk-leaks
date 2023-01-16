<?php

use App\TestWorkflow;
use Temporal\Client\WorkflowClient;
use Temporal\Client\GRPC\ServiceClient;
use App\Converter;

require './vendor/autoload.php';

$workflowClient = WorkflowClient::create(
    ServiceClient::create('temporal:7233'),
    null,
    new Converter()
);


$workflow = $workflowClient->newWorkflowStub(
    TestWorkflow::class
);

$workflowClient->start($workflow);
