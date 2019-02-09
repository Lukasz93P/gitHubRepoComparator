<?php

namespace GitHubRepoComparator\Tests\Validation;

use GitHubRepoComparator\Validation\BasicValidator;

class BasicValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BasicValidator
     */
    private $validator;

    protected function setUp()
    {
        parent::setUp();
        $this->validator = new BasicValidator();
    }

    public function testShouldNotThrowValidationException()
    {
        $data = array('testKey' => 'testValue');
        $rules = array('testKey' => 'notempty');

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $this->fail('Validation Exception was thrown ' . $exception->getMessage());
        }

        $this->assertTrue(true);
    }

    public function testShouldThrowValidationException()
    {
        $data = array('testKey' => '', 'secondTestKey' => 'fsdf');
        $rules = array('testKey' => 'notempty', 'secondTestKey' => 'notempty', 'thirdTestKey' => 'notempty');

        $validationException = false;

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $validationException = $exception;
        }

        $this->assertNotEmpty($validationException);
        $this->assertEquals('GitHubRepoComparator\Exception\Validation\ValidationException', get_class($validationException));
        $this->assertEquals(array('testKey' => array('Cannot be empty'), 'thirdTestKey' => array('Cannot be empty')),
            $validationException->getValidationErrors());
    }

    public function testShouldNotThrowValidationExceptionForMaxValue()
    {
        $data = array('testKey' => 'testValue', 'secondTestKey' => 'veeeeryLonggggWorddddd');
        $rules = array('testKey' => 'max:10', 'secondTestKey' => 'max:40');

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $this->fail('Validation Exception was thrown ' . $exception->getMessage());
        }

        $this->assertTrue(true);
    }

    public function testShouldThrowValidationExceptionForMaxValue()
    {
        $data = array('testKey' => 'testValue', 'secondTestKey' => 'veeeeryLonggggWorddddd');
        $rules = array('testKey' => 'max:10', 'secondTestKey' => 'max:4');

        $testException = false;

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
        $this->assertEquals(array('secondTestKey' => array('Cannot be greater than 4')), $testException->getValidationErrors());
    }

    public function testShouldNotThrowValidationExceptionForMinValue()
    {
        $data = array('testKey' => 'testValue', 'secondTestKey' => 'veeeeryLonggggWorddddd');
        $rules = array('testKey' => 'min:1', 'secondTestKey' => 'min:4');

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $this->fail('Validation Exception was thrown ' . $exception->getMessage());
        }

        $this->assertTrue(true);
    }

    public function testShouldThrowValidationExceptionForMinValue()
    {
        $data = array('testKey' => 'testValue', 'secondTestKey' => 'veeeeryLonggggWorddddd');
        $rules = array('testKey' => 'min:10', 'secondTestKey' => 'min:4');

        $testException = false;

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
        $this->assertEquals(array('testKey' => array('Cannot be lower/shorter than 10')), $testException->getValidationErrors());
    }

    public function testShouldThrowValidationExceptionForMaxValueWithMinAlsoSpecified(){
        $data = array('testKey' => 'testValue', 'secondTestKey' => 'veeeeryLonggggWorddddd');
        $rules = array('testKey' => 'max:10', 'secondTestKey' => 'max:4|min:2');

        $testException = false;

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
        $this->assertEquals(array('secondTestKey' => array('Cannot be greater than 4')), $testException->getValidationErrors());
    }
}