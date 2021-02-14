<?php
declare(strict_types=1);
/**
 * Date: 13.02.21
 * Time: 23:00
 */
namespace App\Adjutants;

class LogAdjutant
{

    public static function makeLogMessage(\Throwable $e): string
    {
        return $e->getMessage()."|".$e->getFile()."|line ".$e->getLine()."\n";
    }
}
