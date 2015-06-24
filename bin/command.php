<?php
use Symfony\Component\Console\Application;
use buvette\Command\GenerateEntitiesCommand;

$app = new Application('Raulnet', '0.1.0');
$app->add(new GenerateEntitiesCommand());
$app->run();