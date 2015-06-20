<?php
use Symfony\Component\Console\Application;
use buvette\Command\TestCommand;

$app = new Application('Raulnet', '0.1.0');
$app->add(new TestCommand());
$app->run();