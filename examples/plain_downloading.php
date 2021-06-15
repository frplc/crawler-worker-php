<?php
declare(strict_types=1);
require __DIR__.'/../vendor/autoload.php';

use \App\Commands\ClientCommand;

$command = new ClientCommand();
$command->handle();
