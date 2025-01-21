<?php

namespace App\Helpers\Services;

use App\Exceptions\ViaCepException;
use App\Helpers\CurlRequest;

class ViaCEP extends AbstractService {
    const API_URL_BASE = "https://viacep.com.br/ws/{{CEP}}/json";
    private $cep;

    public function setCep(string $cep): self 
    {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        if (strlen($cep) !== 8) {
            throw new ViaCepException("CEP informado é inválido", 400);
        }

        $this->cep = $cep;
        return $this;
    }

    public function run(): array 
    {
        $endpoint = self::API_URL_BASE;
        $endpoint = str_replace("{{CEP}}", $this->cep, $endpoint);

        $curl = new CurlRequest();
        $curl
            ->setEndpoint($endpoint)
            ->setMethod("GET")
            ->setHeaders(["User-Agent" => "curl/7.64.1"])
            ->send();

        if (!in_array($curl->getHttpCode(), [200, 201]) ) {
            throw new ViaCepException("Erro ao consultar endereço");
        }

        return $curl->getResponse();
    }
}