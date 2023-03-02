<?php
// index.php
declare(strict_types = 1);

require_once 'vendor/autoload.php';

/* remove from here */
use App\Services\MessengerService;

MessengerService::add('Welcome, you are using mvc-template');
/* remove until here */

header('location: homeController.php');
