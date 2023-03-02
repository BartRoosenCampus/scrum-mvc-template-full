<?php

namespace App;

use App\Entities\Log;

class Toolbox
{
    public static function makePage()
    {
        $vieuws = "App/Views/";

        echo "Welkcome to makepage\n";
        echo "====================\n\n";

        $pageName   = readline("Select a page name : ");
        $controller = sprintf('%sController.php', strtolower($pageName));

        $controllerContent   = file_get_contents('templates/controllerTemplate.php');
        $twigTemplateContent = file_get_contents('templates/template.twig');
//        $navBarLinks         = file_get_contents('App/Views/components/navbarlinks.twig');
        $linkHtml            = file_get_contents('templates/link.html');

        $pageDisplayName     = ucfirst($pageName);
        $link                = sprintf($linkHtml, $controller, $pageDisplayName);


        $fh = fopen($controller, "a");
        fwrite($fh, sprintf($controllerContent, $controller, $pageDisplayName, sprintf('%s/index.twig', $pageName)));
        fclose($fh);
        echo "Controller created\n";

        $viewDirectory = sprintf('App/Views/%s', str_replace(' ', '-', $pageName));

        mkdir($viewDirectory);
        echo "View directory created\n";

        $fh = fopen(sprintf('%s/index.twig', $viewDirectory), "a");
        fwrite($fh, $twigTemplateContent);
        fclose($fh);
        echo "View created\n";

        $fh = fopen('App/Views/components/navbarlinks.twig', "a");
        fwrite($fh, $link);
        fclose($fh);
        echo "Link created\n";
        Log::create(sprintf('Page %s has been created', $pageDisplayName))->add();
    }

    public static function printArray(array $array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}
