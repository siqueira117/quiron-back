<?php

use App\Helpers\Services\GeoLoc;

require_once(__DIR__."/vendor/autoload.php");

$geoLoc = new GeoLoc();
$geoLoc
    ->setStreet("Rua Carlos Henrique")
    ->setNumber(11)
    ->setCounty("Miguel Couto")
    ->setState("Rio de Janeiro")
    ->setCity("Nova Iguaçu")
    ->run();