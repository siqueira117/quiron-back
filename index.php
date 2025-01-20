<?php

use App\Helpers\Services\Cnpja;
require_once(__DIR__."/vendor/autoload.php");

$viaCep = new Cnpja();
$viaCep
    ->setCnpj("00.776.574/0001-6")
    ->run();