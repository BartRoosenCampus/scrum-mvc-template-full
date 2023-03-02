<?php

namespace App\Services;

use Symfony\Component\Yaml\Parser;

class YamlService
{
    private static string $filepath = 'App/YAML/%s.yml';

    public static function parseFile(string $file)
    {
        $parser = new Parser();

        return $parser->parseFile(sprintf(self::$filepath, $file));
    }
}