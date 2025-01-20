<?php

namespace App\Helpers;

use App\Exceptions\CurlRequestException;

class CurlRequest
{
    private $endpoint;
    private $method;
    private $headers;
    private $bodyRequest;
    private $curl;
    private $response;
    private $httpcode;

    public function __construct()
    {
        $this->curl = curl_init();
    }

    public function setEndpoint(string $endpoint, ?array $params = null): self
    {
        if ($params) {
            $endpoint = str_replace(array_keys($params), array_values($params), $endpoint);
        }

        $this->endpoint = $endpoint;
        return $this;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        return $this;
    }

    public function setResponse(?array $response): void
    {
        $this->response = $response;
    }

    public function getResponse(): ?array
    {
        return $this->response;
    }

    public function setHttpCode(int $httpcode): void
    {
        $this->httpcode = $httpcode;
    }

    /**
     * Retorna HTTP CODE da ultima requisição realizada
     * 
     * @return int código http
     */
    public function getHttpCode(): int
    {
        return $this->httpcode;
    }

    public function setBodyRequest(string $bodyRequest): self
    {
        $this->bodyRequest = $bodyRequest;

        return $this;
    }

    public function reset(): void
    {
        $this->endpoint     = null;
        $this->method       = null;
        $this->headers      = null;
        $this->bodyRequest  = null;
    }

    public function send(): ?array
    {
        Logger::register(LOG_NOTICE, "Preparando requisição...");

        $curl = $this->curl;

        $curlOptions = [
            CURLOPT_URL             => $this->endpoint,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_ENCODING        => '',
            CURLOPT_MAXREDIRS       => 10,
            CURLOPT_TIMEOUT         => 0,
            CURLOPT_FOLLOWLOCATION  => true,
            CURLOPT_HTTP_VERSION    => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST   => $this->method,
        ];

        Logger::register(LOG_NOTICE, ">> Method: " . $this->method);

        if ($this->headers) {
            $curlOptions[CURLOPT_HTTPHEADER] = $this->headers;
            Logger::register(LOG_NOTICE, ">> Headers: " . json_encode($this->headers));
        }

        if ($this->bodyRequest) {
            $bodyRequest = is_array($this->bodyRequest) ? json_encode($this->bodyRequest) : $this->bodyRequest;
            Logger::register(LOG_NOTICE, ">> BodyRequest: $bodyRequest");
            
            $curlOptions[CURLOPT_POSTFIELDS] = $this->bodyRequest;
        }

        curl_setopt_array($curl, $curlOptions);

        $responseOriginal = trim(curl_exec($curl));
        Logger::register(LOG_NOTICE, ">> Response: $responseOriginal");

        $response = json_decode($responseOriginal, true);
        $curlerro = curl_error($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $httptime = curl_getinfo($curl, CURLINFO_TOTAL_TIME);

        Logger::register(LOG_NOTICE, ">> Endpoint: " . $this->endpoint);
        Logger::register(LOG_NOTICE, ">> Tempo de resposta: $httptime");
        Logger::register(LOG_NOTICE, ">> HTTP Code: $httpcode");

        // Interpretando retorno da API
        if (!empty($curlerro)) {
            throw new CurlRequestException("Curl error # $curlerro");
        }

        $this->setResponse($response);
        $this->setHttpCode($httpcode);

        return $response;
    }
}
