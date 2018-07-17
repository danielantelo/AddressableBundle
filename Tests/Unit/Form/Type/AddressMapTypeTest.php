<?php

namespace Addressable\Bundle\Tests\Unit\Form\Type;

use Addressable\Bundle\Document\Address;
use Addressable\Bundle\Form\Type\AddressMapType;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Ensures correct behaviour of AddressMapType
 */
class AddressMapTypeTest extends TypeTestCase
{
    /**
     * Test submitting valid data
     *
     * @test
     * @dataProvider getValidTestData
     */
    public function testSubmitValidData($data)
    {
        // create and submit the data to the form directly
        $actualAddress = new Address();
        $form = $this->factory->create(AddressMapType::class, $actualAddress);
        $form->submit($data);

        $this->assertTrue($form->isSynchronized(), 'Data transformer ok');
        $this->assertTrue($form->isValid(), 'Form is valid');

        // ensure form has expected fields
        $view = $form->createView();
        $children = $view->children;
        foreach (array_keys($data) as $key) {
            $this->assertArrayHasKey($key, $children, 'Form contains ' . $key);
        }
    }

    /**
     * Returns sets of valid form data
     *
     * @return array
     */
    public function getValidTestData()
    {
        return array(
            array(
                'data' => array(
                    'streetNumber' => '14',
                    'streetName' => 'Clanricarde Gardens',
                    'city' => 'London',
                    'country' => 'United Kingdom'
                )
            )
        );
    }
}
