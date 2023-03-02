<?php

namespace App\Services;

use App\Entities\Log;

class LogService
{
    private static string $path = 'App/Logs/';

    public static function add(Log $log): void
    {
        $file = sprintf('%s%s.log', self::$path, date('Ymd'));
        $fh = fopen($file, "a");
        fwrite(
            $fh,
            sprintf(
                '[%s][%s] => %s',
                date('Y.m.d H:i:s'),
                $log->getType(),
                $log->getMessage()) . "\n"
        );
        fclose($fh);
    }

    public static function viewLogInTerminal(): void
    {
        $logFiles = scandir('App/Logs');
        unset($logFiles[0], $logFiles[1], $logFiles[array_search('README.md', $logFiles)]);

        foreach ($logFiles as $file) {
            $fileContent = file_get_contents(sprintf('App/Logs/%s', $file));

            echo $fileContent;
        }
    }
}