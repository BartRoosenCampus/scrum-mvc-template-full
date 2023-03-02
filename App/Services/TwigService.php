<?php

namespace App\Services;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigService
{
    /** @var FilesystemLoader */
    private $loader;

    /** @var Environment */
    private $twig;

    private array $parameters = [];

    public function __construct()
    {
        $this->loader                = new FilesystemLoader('App/Views');
        $this->twig                  = new Environment($this->loader);
        $this->parameters['message'] = MessengerService::get();
        $this->parameters['tab']     = 'mvc-template';
    }

    public function renderPage(string $view)
    {
        echo $this->twig->render($view, $this->parameters);
    }

    public function addParameter(string $key, mixed $value)
    {
        $this->parameters[$key] = $value;
    }
}
