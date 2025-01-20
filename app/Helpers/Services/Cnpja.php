<?php

namespace App\Helpers\Services;

use App\Exceptions\CnpjaException;
use App\Helpers\CurlRequest;

class Cnpja extends AbstractService {
    const API_URL_BASE = "https://open.cnpja.com/office/{{CNPJ}}";
    private $cnpj;

    public function setCnpj(string $cnpj): self
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        if (strlen($cnpj) !== 14) {
            throw new CnpjaException("CNPJ informado é inválido", 400);
        }

        $this->cnpj = $cnpj;
        return $this;
    }

    public function run(): array
    {
        $endpoint = self::API_URL_BASE;
        $endpoint = str_replace("{{CNPJ}}", $this->cnpj, $endpoint);

        $curl = new CurlRequest();
        $curl
            ->setEndpoint($endpoint)
            ->setMethod("GET")
            ->setHeaders(["User-Agent" => "PostmanRuntime/7.43.0"])
            ->send();

        if (!in_array($curl->getHttpCode(), [200, 201]) ) {
            throw new CnpjaException("Erro ao consultar dados na receita");
        }

        return $curl->getResponse();
    } 
}