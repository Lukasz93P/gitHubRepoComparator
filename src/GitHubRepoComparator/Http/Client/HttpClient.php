<?php

namespace GitHubRepoComparator\Http\Client;

use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;

interface HttpClient
{
    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_DELETE = 'delete';
    const METHOD_PUT = 'put';

    /**
     * @param string $username
     * @param string $password
     * @return $this
     */
    public function setBasicAuth($username, $password);

    /**
     * @param array $headers
     * @return $this
     */
    public function setHeaders($headers);

    /**
     * @param array $cookies
     * @return $this
     */
    public function setCookies($cookies);

    /**
     * @param string $url
     * @param string $method
     * @return $this
     * @throws HttpClientException
     */
    public function sendRequest($url, $method);

    /**
     * @param array $data
     * @return $this
     */
    public function setData($data);

    /**
     * @param string|null $key
     * @return array|mixed
     */
    public function getResponseData($key = null);
}