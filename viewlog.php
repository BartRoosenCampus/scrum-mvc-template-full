<?php
// test.php
declare(strict_types = 1);

use App\Services\LogService;
use App\Entities\Log;

include_once 'vendor/autoload.php';

Log::create('Open log in terminal')->add();
LogService::viewLogInTerminal();
