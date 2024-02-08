<?php

declare(strict_types=1);

namespace Hermann\MMS\Playground;

include_once 'errorReporting.php';

class AnotherPlayground
{
    public function __construct()
    {
        $ds = "hi";
        echo("goodbye world $ds<br>");
        echo('goodbye world $ds<br>');
    }


}