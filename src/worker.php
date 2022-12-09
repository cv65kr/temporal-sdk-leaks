<?php

use Temporal\WorkerFactory;
use App\TestWorkflow;
use App\Activity;

require './vendor/autoload.php';

$factory = WorkerFactory::create();

// Worker that listens on a task queue and hosts both workflow and activity implementations.
$worker = $factory->newWorker();

$worker->registerWorkflowTypes(TestWorkflow::class);
$worker->registerActivity(Activity::class);
$factory->run();

