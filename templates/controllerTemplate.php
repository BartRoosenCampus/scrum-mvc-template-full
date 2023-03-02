<?php
// %s
declare(strict_types = 1);

use App\Services\TwigService;

require_once 'vendor/autoload.php';
$twigService = new TwigService();

$twigService->addParameter('header', '%s');
$twigService->renderPage('%s');
