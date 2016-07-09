<?php

namespace Osl\Bundle\Common\Tests\Unit\Services;

use Addressable\Bundle\Model\GeoPointInterface;
use Addressable\Bundle\Services\GeospatialHelper;

class GeospatialHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test sorting point by distance to a point
     *
     * @param GeoPointInterface $center
     * @param array             $points
     * @param array             $expectedOrder
     *
     * @dataProvider sortProvider
     */
    public function testSort(GeoPointInterface $center, array $points, array $expectedOrder)
    {
        $sorter = new GeospatialHelper();

        $sortedResults = $sorter->sortAroundCenterPoint($center, $points);

        $this->assertEquals(
            $this->addressableCollectionToArray($expectedOrder),
            $this->addressableCollectionToArray($sortedResults)
        );
    }

    /**
     * Test filtering out points which are further than X distance
     *
     * @param GeoPointInterface $center
     * @param array             $points
     * @param array             $expectedResults
     * @param float             $radius
     *
     * @dataProvider filterProvider
     */
    public function testFiltering(
        GeoPointInterface $center,
        array $points,
        array $expectedResults,
        $radius
    ) {
        $sorter = new GeospatialHelper();

        $sortedResults = $sorter->filterPointsWithinRadius($center, $points, $radius);

        $this->assertEquals(
            $this->addressableCollectionToArray($expectedResults),
            $this->addressableCollectionToArray($sortedResults)
        );
    }

    /**
     * Data provider for test
     *
     * @return array
     */
    public function sortProvider()
    {
        return array(
            'ordering_by_distance' => array(
                'center' => $this->createAddressable(51.528232, -0.019206),
                'points' => array(
                    $this->createAddressable(51.544276, -0.011863),
                    $this->createAddressable(51.529765, -0.086517),
                    $this->createAddressable(51.531812, -0.023036),
                    $this->createAddressable(51.541002, -0.006615),
                ),
                'expected' => array(
                    $this->createAddressable(51.531812, -0.023036),
                    $this->createAddressable(51.541002, -0.006615),
                    $this->createAddressable(51.544276, -0.011863),
                    $this->createAddressable(51.529765, -0.086517),
                ),
                'closerThan' => null,
            ),
        );
    }

    /**
     * Data provider for test
     *
     * @return array
     */
    public function filterProvider()
    {
        return array(
            'filtering_for_closer_than_2.5km' => array(
                'center' => $this->createAddressable(51.528232, -0.019206),
                'points' => array(
                    $this->createAddressable(51.544276, -0.011863),
                    $this->createAddressable(51.529765, -0.086517),
                    $this->createAddressable(51.531812, -0.023036),
                    $this->createAddressable(51.541002, -0.006615),
                ),
                'expected' => array(
                    $this->createAddressable(51.544276, -0.011863),
                    $this->createAddressable(51.531812, -0.023036),
                    $this->createAddressable(51.541002, -0.006615),
                ),
                'closerThan' => 2.5,
            ),
        );
    }

    /**
     * Creates an addressable content interface mock
     *
     * @param float $lat
     * @param float $lon
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|GeoPointInterface
     */
    private function createAddressable($lat, $lon)
    {
        $addressable = $this->getMock(GeoPointInterface::class);
        $addressable->expects($this->atLeastOnce())
            ->method('getLatitude')
            ->will($this->returnValue($lat));
        $addressable->expects($this->atLeastOnce())
            ->method('getLongitude')
            ->will($this->returnValue($lon));

        return $addressable;
    }

    /**
     * Converts an array of addressable content to lat, long arrays
     *
     * @param array $collection
     *
     * @return array
     */
    private function addressableCollectionToArray($collection)
    {
        $result = array();
        foreach ($collection as $address) {
            $result[] = $this->addressableToArray($address);
        }

        return $result;
    }

    /**
     * Converts an addressable content to lat, long
     *
     * @param GeoPointInterface $address
     *
     * @return array
     */
    private function addressableToArray(GeoPointInterface $address)
    {
        return array(
            $address->getLatitude(),
            $address->getLongitude(),
        );
    }
}
