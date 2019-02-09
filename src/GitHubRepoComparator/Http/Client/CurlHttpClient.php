<?php

namespace GitHubRepoComparator\Http\Client;

use Curl\Curl;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;

/**
 * Class CurlHttpClient
 * @package Stereotypes\HttpStereotypes\HttpClient
 */
class CurlHttpClient implements HttpClient
{
    /**
     * @var Curl
     */
    private $curl;

    /**
     * @var array
     */
    private $data = array();

    /**
     * @var array
     */
    private $responseData = array();

    /**
     * CurlHttpClient constructor.
     * @param Curl|null $curl
     * @throws \ErrorException
     */
    public function __construct(Curl $curl = null)
    {
        $this->curl = $curl ? $curl : new Curl();
    }

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function setBasicAuth($username, $password)
    {
        $this->curl->setBasicAuthentication($username, $password);

        return $this;
    }

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders($headers)
    {
        foreach ($headers as $key => $value) {
            $this->curl->setHeader($key, $value);
        }

        return $this;
    }

    /**
     * @param array $cookies
     * @return $this
     */
    public function setCookies($cookies)
    {
        foreach ($cookies as $key => $value) {
            $this->curl->setCookie($key, $value);
        }

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param string $url
     * @param string $method
     * @return $this
     * @throws HttpClientException
     */
    public function sendRequest($url, $method)
    {
        $this->curl->$method($url, $this->data);
        if ($this->curl->error) {
            throw new HttpClientException($this->curl->error_message, $this->curl->error_code);
        }

        $this->responseData = json_decode($this->curl->response, true);

        return $this;
    }

    /**
     * @param string|null $key
     * @return array|mixed|null
     */
    public function getResponseData($key = null)
    {
        return $key ? (isset($this->responseData[$key]) ? $this->responseData[$key] : null) : $this->responseData;
    }
}