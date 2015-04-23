<?php

namespace Addressable\Bundle\Tests\Unit\Form\Type;

use Addressable\Bundle\Validator\Constraints\Longitude;
use Addressable\Bundle\Validator\Constraints\LongitudeValidator;

/**
 * Ensures correct behaviour of LongitudeValidator
 */
class LongitudeValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test submitting valid data
     *
     * @test
     * @dataProvider getValidTestData
     */
    public function testNoViolationWhenValidLongitude($data)
    {
        $constraint = new Longitude();
        $validator = new LongitudeValidator();
        $context = $this->getMockBuilder('Symfony\\Component\\Validator\\Context\\ExecutionContextInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects($this->never())
            ->method('addViolation');

        $validator->initialize($context);
        $validator->validate($data, $constraint);
    }

    /**
     * Test submitting invvalid data
     *
     * @test
     * @dataProvider getInvalidTestData
     */
    public function testViolationWhenValidLongitude($data)
    {
        $constraint = new Longitude();
        $validator = new LongitudeValidator();
        $context = $this->getMockBuilder('Symfony\\Component\\Validator\\Context\\ExecutionContextInterface')
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects($this->once())
            ->method('addViolation')
            ->with('The value %value% is not a valid longitude.');

        $validator->initialize($context);
        $validator->validate($data, $constraint);
    }

    /**
     * Returns sets of valid form data
     *
     * @return array
     */
    public function getValidTestData()
    {
        return array(
            array('180'),
            array('-180'),
            array('90'),
            array('-90'),
            array('0'),
            array('45.11112121'),
            array('-45.11112121')
        );
    }

    /**
     * Returns sets of valid form data
     *
     * @return array
     */
    public function getInvalidTestData()
    {
        return array(
            array('181'),
            array('-181'),
            array('111111'),
            array('-4000')
        );
    }
}
