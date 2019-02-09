<?php

namespace GitHubRepoComparator\Tests\Serialization\Serializer;

use GitHubRepoComparator\Serialization\Serializer\BasicJsonSerializer;
use GitHubRepoComparator\Serialization\Serializer\Serializer;

class BasicJsonSerializerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Serializer
     */
    private $serializer;

    protected function setUp()
    {
        parent::setUp();
        $this->serializer = new BasicJsonSerializer();
    }

    public function testShouldSerializeResource()
    {
        $serializable = $this->getMock('GitHubRepoComparator\Serialization\Serializable\Serializable',
            array('getSerializableProperties', 'getName', 'getEmail', 'getAge', 'getCity'));

        $serializable->expects($this->exactly(2))
            ->method('getSerializableProperties')
            ->will($this->returnValue(array('name', 'email', 'age')));

        $serializable->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('testName'));

        $serializable->expects($this->once())
            ->method('getEmail')
            ->will($this->returnValue('testEmail'));

        $serializable->expects($this->once())
            ->method('getAge')
            ->will($this->returnValue(20));

        $serializable->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('testName'));

        $serialized = $this->serializer->serialize($serializable);

        $encodedData = json_encode(array('name' => 'testName', 'email' => 'testEmail', 'age' => 20));
        $this->assertSame($serialized, $encodedData);
    }

    public function testShouldSerializeResourceWithEmbeddedObject()
    {
        $city = new \stdClass();
        $city->name = 'TEST CITY';

        $serializable = $this->getMock('GitHubRepoComparator\Serialization\Serializable\Serializable',
            array('getSerializableProperties', 'getName', 'getEmail', 'getAge', 'getCity'));

        $serializable->expects($this->exactly(2))
            ->method('getSerializableProperties')
            ->will($this->returnValue(array('name', 'email', 'age', 'city')));

        $serializable->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('name'));

        $serializable->expects($this->once())
            ->method('getEmail')
            ->will($this->returnValue('email'));

        $serializable->expects($this->once())
            ->method('getAge')
            ->will($this->returnValue(53));

        $serializable->expects($this->once())
            ->method('getCity')
            ->will($this->returnValue($city));

        $serialized = $this->serializer->serialize($serializable);

        $encodedData = json_encode(array('name' => 'name', 'email' => 'email', 'age' => 53,
            'city' => array('name' => 'TEST CITY')));

        $this->assertSame($serialized, $encodedData);
    }

    public function testShouldThrowRuntimeException()
    {

        $serializable = $this->getMock('GitHubRepoComparator\Serialization\Serializable\Serializable',
            array('getSerializableProperties'));

        $serializable->expects($this->exactly(2))
            ->method('getSerializableProperties')
            ->will($this->returnValue(array()));

        $this->setExpectedException('RuntimeException', get_class($serializable) . ' has no serializable fields.');
        $this->serializer->serialize($serializable);
    }
}