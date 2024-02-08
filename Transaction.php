<?php

declare(strict_types=1);

//namespace Hermann\MMS\Playground;

use Hermann\MMS\Playground\Playground;

include_once 'errorReporting.php';
require_once 'playgroundHKN.php';

$teste = new Playground();

//aufrufen von funktionen
$teste->lol();

//aufrufen des magic __invoke
$teste('World');

//__getter und __setter für nicht-existierende werte
$teste->a = 1;
echo "non-existent variable: $teste->a<br>";

//Aufrufen von nicht definierten funktionen
$teste->runTest('param1', 'param2');

echo "<br>" . $teste;
