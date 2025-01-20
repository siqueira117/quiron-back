<?php

use App\Helpers\Services\GeoLoc;
use App\Helpers\Services\ViaCEP;

require_once(__DIR__."/vendor/autoload.php");

$viaCep = new ViaCEP();
$viaCep
    ->setCep("26070374")
    ->run();