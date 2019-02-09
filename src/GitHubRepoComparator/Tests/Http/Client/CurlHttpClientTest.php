<?php

namespace GitHubRepoComparator\Tests\Http\Client;

use Curl\Curl;
use GitHubRepoComparator\Exception\HttpClientException\HttpClientException;
use GitHubRepoComparator\Http\Client\CurlHttpClient;
use GitHubRepoComparator\Http\Client\HttpClient;

class CurlHttpClientTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CurlHttpClient
     */
    private $curlHttpClient;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $curlMock;

    protected function setUp()
    {
        parent::setUp();
        $this->curlMock = $this->getMock('Curl\Curl',
            array('setBasicAuthentication', 'setHeader', 'setCookie', 'post', 'get'));

        $this->curlHttpClient = new CurlHttpClient($this->curlMock);
    }

    public function testShouldSetBaseAuth()
    {
        $this->curlMock->expects($this->once())
            ->method('setBasicAuthentication')
            ->with('testUsername', 'testPassword');

        $this->curlHttpClient->setBasicAuth('testUsername', 'testPassword');
    }

    public function testShouldSetHeaders()
    {
        $this->curlMock->expects($this->exactly(3))
            ->method('setHeader')
            ->withConsecutive(
                array('testKey1', 'testValue1'),
                array('testKey2', 'testValue2'),
                array('testKey3', 'testValue3')
            );

        $this->curlHttpClient
            ->setHeaders(array('testKey1' => 'testValue1', 'testKey2' => 'testValue2', 'testKey3' => 'testValue3'));
    }

    public function testShouldSetCookies()
    {
        $this->curlMock->expects($this->exactly(3))
            ->method('setCookie')
            ->withConsecutive(
                array('testKey1', 'testValue1'),
                array('testKey2', 'testValue2'),
                array('testKey3', 'testValue3')
            );

        $this->curlHttpClient
            ->setCookies(array('testKey1' => 'testValue1', 'testKey2' => 'testValue2', 'testKey3' => 'testValue3'));
    }

    public function testShouldSendGetRequestWithNoData()
    {
        $this->curlMock->expects($this->once())
            ->method(HttpClient::METHOD_GET)
            ->with('testUrl', array());

        $this->curlHttpClient->sendRequest('testUrl', HttpClient::METHOD_GET);
    }

    public function testShouldSendGetRequestWithData()
    {
        $dataArray = array('testDataKey' => 'testDataValue');

        $this->curlMock->expects($this->once())
            ->method(HttpClient::METHOD_GET)
            ->with('testUrl', $dataArray);

        $this->curlHttpClient->setData($dataArray);

        $this->curlHttpClient->sendRequest('testUrl', HttpClient::METHOD_GET);
    }

    public function testShouldSendPostRequestWithNoData()
    {
        $this->curlMock->expects($this->once())
            ->method(HttpClient::METHOD_POST)
            ->with('testUrl', array());

        $this->curlHttpClient->sendRequest('testUrl', HttpClient::METHOD_POST);
    }

    public function testShouldSendPostRequestWithData()
    {
        $dataArray = array('testDataKey' => 'testDataValue');

        $this->curlMock->expects($this->once())
            ->method(HttpClient::METHOD_POST)
            ->with('testUrl', $dataArray);

        $this->curlHttpClient->setData($dataArray);

        $this->curlHttpClient->sendRequest('testUrl', HttpClient::METHOD_POST);
    }

    public function testShouldThrowHttpClientException()
    {
        $this->curlMock->expects($this->once())
            ->method(HttpClient::METHOD_POST)
            ->with('testUrl', array());
        $this->curlMock->error = true;
        $this->curlMock->error_code = 500;
        $this->curlMock->error_message = 'testExceptionMessage';

        $testException = false;
        try {
            $this->curlHttpClient->sendRequest('testUrl', HttpClient::METHOD_POST);
        } catch (\Exception $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
        $this->assertEquals($testException->getMessage(), 'testExceptionMessage');
        $this->assertEquals($testException->getCode(), 500);
    }

    public function testShouldReturnDecodedResponseData()
    {
        $responseData = array('testKey' => 'testValue', 'nextTestKey' => 5,
            'thirdKey' => array('testSmth', 'testKey' => 'responseValue'));

        $this->curlMock->expects($this->once())
            ->method(HttpClient::METHOD_POST)
            ->with('testUrl', array());

        $this->curlMock->response = json_encode($responseData);

        $this->curlHttpClient->sendRequest('testUrl', HttpClient::METHOD_POST);

        $this->assertEquals($responseData, $this->curlHttpClient->getResponseData());
    }

    public function testShouldReturnDecodedResponseProperty(){
        $responsePart = array('testSmth', 'testKey' => 'responseValue');
        $responseData = array('testKey' => 'testValue', 'nextTestKey' => 5,
            'thirdKey' => $responsePart);

        $this->curlMock->expects($this->once())
            ->method(HttpClient::METHOD_POST)
            ->with('testUrl', array());

        $this->curlMock->response = json_encode($responseData);

        $this->curlHttpClient->sendRequest('testUrl', HttpClient::METHOD_POST);

        $this->assertEquals($responsePart, $this->curlHttpClient->getResponseData('thirdKey'));
    }
}