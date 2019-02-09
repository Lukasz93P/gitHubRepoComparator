<?php

namespace GitHubRepoComparator\Http\Client;

interface HttpClient
{
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