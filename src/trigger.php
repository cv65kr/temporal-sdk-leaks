<?php

use App\TestWorkflow;
use Temporal\Client\WorkflowClient;
use Temporal\Client\GRPC\ServiceClient;

require './vendor/autoload.php';

$workflowClient = WorkflowClient::create(ServiceClient::create('temporal:7233'));


$workflow = $workflowClient->newWorkflowStub(
    TestWorkflow::class
);

$workflowClient->start($workflow);
