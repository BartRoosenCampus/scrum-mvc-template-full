<?php
// homeController.php
declare(strict_types = 1);

require_once 'vendor/autoload.php';

use App\Services\TwigService;


$twigService = new TwigService();

$twigService->addParameter('header', 'Home');
$twigService->renderPage('home/index.twig');
