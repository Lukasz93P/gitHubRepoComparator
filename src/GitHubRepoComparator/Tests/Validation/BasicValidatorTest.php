<?php

namespace GitHubRepoComparator\Tests\Validation;

use GitHubRepoComparator\Tests\TestUtils;
use GitHubRepoComparator\Validation\BasicValidator;
use GitHubRepoComparator\Validation\Validator;

class BasicValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var BasicValidator
     */
    private $validator;

    /**
     * @var array
     */
    private $testData;

    protected function setUp()
    {
        parent::setUp();
        $this->validator = new BasicValidator();
        $this->testData = array(TestUtils::FIRST_TEST_KEY => TestUtils::FIRST_TEST_VALUE,
            TestUtils::SECOND_TEST_KEY => 'veeeeryLonggggWorddddd');
    }

    public function testShouldNotThrowValidationException()
    {
        $data = array(TestUtils::FIRST_TEST_KEY => TestUtils::FIRST_TEST_VALUE);
        $rules = array(TestUtils::FIRST_TEST_KEY => Validator::NOT_EMPTY_VALIDATION_RULE);

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $this->fail('Validation Exception was thrown ' . $exception->getMessage());
        }

        $this->assertTrue(true);
    }

    public function testShouldThrowValidationException()
    {
        $data = array(TestUtils::FIRST_TEST_KEY => '', TestUtils::SECOND_TEST_KEY => 'fsdf');
        $rules = array(TestUtils::FIRST_TEST_KEY => Validator::NOT_EMPTY_VALIDATION_RULE,
            TestUtils::SECOND_TEST_KEY => Validator::NOT_EMPTY_VALIDATION_RULE,
            TestUtils::THIRD_TEST_KEY => Validator::NOT_EMPTY_VALIDATION_RULE);

        $validationException = false;

        try {
            $this->validator->validate($rules, $data);
        } catch (\Exception $exception) {
            $validationException = $exception;
        }

        $this->assertNotEmpty($validationException);
        $this->assertEquals('GitHubRepoComparator\Exception\Validation\ValidationException', get_class($validationException));
        $this->assertEquals(array(TestUtils::FIRST_TEST_KEY => array('Cannot be empty'),
            TestUtils::THIRD_TEST_KEY => array('Cannot be empty')),
            $validationException->getValidationErrors());
    }

    public function testShouldNotThrowValidationExceptionForMaxValue()
    {
        $rules = array(TestUtils::FIRST_TEST_KEY => Validator::MAX_VALIDATION_RULE . ':10',
            TestUtils::SECOND_TEST_KEY => Validator::MAX_VALIDATION_RULE . ':40');

        try {
            $this->validator->validate($rules, $this->testData);
        } catch (\Exception $exception) {
            $this->fail('Validation Exception was thrown ' . $exception->getMessage());
        }

        $this->assertTrue(true);
    }

    public function testShouldThrowValidationExceptionForMaxValue()
    {
        $rules = array(TestUtils::FIRST_TEST_KEY => Validator::MAX_VALIDATION_RULE . ':10',
            TestUtils::SECOND_TEST_KEY => Validator::MAX_VALIDATION_RULE . ':4');

        $testException = false;

        try {
            $this->validator->validate($rules, $this->testData);
        } catch (\Exception $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
        $this->assertEquals(array(TestUtils::SECOND_TEST_KEY => array('Cannot be greater than 4')), $testException->getValidationErrors());
    }

    public function testShouldNotThrowValidationExceptionForMinValue()
    {
        $rules = array('testKey' => 'min:1', 'secondTestKey' => 'min:4');

        try {
            $this->validator->validate($rules, $this->testData);
        } catch (\Exception $exception) {
            $this->fail('Validation Exception was thrown ' . $exception->getMessage());
        }

        $this->assertTrue(true);
    }

    public function testShouldThrowValidationExceptionForMinValue()
    {
        $rules = array(TestUtils::FIRST_TEST_KEY => Validator::MAX_VALIDATION_RULE . ':10',
            TestUtils::SECOND_TEST_KEY => Validator::MIN_VALIDATION_RULE . ':4');

        $testException = false;

        try {
            $this->validator->validate($rules, $this->testData);
        } catch (\Exception $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
        $this->assertEquals(array('testKey' => array('Cannot be lower/shorter than 10')),
            $testException->getValidationErrors());
    }

    public function testShouldThrowValidationExceptionForMaxValueWithMinAlsoSpecified()
    {
        $rules = array(TestUtils::FIRST_TEST_KEY => Validator::MAX_VALIDATION_RULE . ':10',
            TestUtils::SECOND_TEST_KEY => Validator::MAX_VALIDATION_RULE . ':4|' . Validator::MIN_VALIDATION_RULE . ':2');

        $testException = false;

        try {
            $this->validator->validate($rules, $this->testData);
        } catch (\Exception $exception) {
            $testException = $exception;
        }

        $this->assertNotEmpty($testException);
        $this->assertEquals(array('secondTestKey' => array('Cannot be greater than 4')),
            $testException->getValidationErrors());
    }
}