<?php

namespace App\Helpers\Services;

use App\Exceptions\GeoLocException;
use App\Helpers\CurlRequest;

class GeoLoc extends AbstractService {
    const API_URL_BASE  = "https://nominatim.openstreetmap.org/search";
    const VALID_FORMATS = ["xml", "json", "jsonv2", "geojson", "geocodejson"];

    // Campos enviados via API Nominatim
    // Não alterar os valores
    private $queryParams = [
        'format'    => 'json',
        'street'    => null,
        'number'    => null,
        'country'   => 'Brasil',
        'county'    => null,
        'state'     => null,
        'city'      => null
    ];

    // Setters
    public function setFormat(string $format): self 
    {
        $format = strtolower($format);
        if (!in_array($format, self::VALID_FORMATS)) {
            throw new GeoLocException("Formato informado é incorreto");
        }

        $this->queryParams["format"] = $format;
        return $this;
    }

    public function setStreet(string $street): self 
    {
        $street = strtolower($street);

        $this->queryParams["street"] = $street;
        return $this;
    }

    public function setNumber(int $number): self 
    {
        $this->queryParams["number"] = $number;
        return $this;
    }

    public function setCountry(string $country): self 
    {
        $country = strtolower($country);

        $this->queryParams["country"] = $country;
        return $this;
    }

    public function setCounty(string $county): self 
    {
        $county = strtolower($county);

        $this->queryParams["county"] = $county;
        return $this;
    }

    public function setState(string $state): self 
    {
        $state = strtolower($state);

        $this->queryParams["state"] = $state;
        return $this;
    }

    public function setCity(string $city): self 
    {
        $city = strtolower($city);

        $this->queryParams["city"] = $city;
        return $this;
    }

    private function getParams(): string 
    {
        $params = [ "format" => $this->queryParams["format"] ];

        foreach ($this->queryParams as $field => $value) {
            if (!$value) {
                throw new GeoLocException("Campo '$field' para consulta não foi informado");
            }

            $params[$field] = $value;
        }

        $params["street"] = "{$params['number']} {$params['street']}";
        unset($params['number']);

        return http_build_query($params);
    }

    public function run(): array
    {
        $queryParams    = $this->getParams();
        $endpoint       = self::API_URL_BASE . "?$queryParams";

        $curl = new CurlRequest();
        $curl
            ->setEndpoint($endpoint)
            ->setMethod("GET")
            ->setHeaders(["User-Agent" => "PostmanRuntime/7.43.0"])
            ->send();

        if (!in_array($curl->getHttpCode(), [200, 201]) ) {
            throw new GeoLocException("Erro ao consultar endereço");
        }

        return $curl->getResponse();
    } 
}