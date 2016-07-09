<?php

namespace Addressable\Bundle\Services;

use Addressable\Bundle\Model\GeoPointInterface;

class GeospatialHelper
{
    /**
     * Sorts addressable content models around a center point by distance.
     *
     * @param GeoPointInterface   $centerPoint
     * @param GeoPointInterface[] $points
     *
     * @return GeoPointInterface[]
     */
    public function sortAroundCenterPoint(GeoPointInterface $centerPoint, $points)
    {
        $pointsAndDistances = array();
        foreach ($points as $point) {
            if (!$point instanceof GeoPointInterface) {
                continue;
            }

            $distance = $this->getDistanceBetweenPoints($centerPoint, $point);

            $pointsAndDistances[] = array(
                'point'    => $point,
                'distance' => $distance,
            );
        }

        usort($pointsAndDistances, function ($a, $b) {
            if ($a['distance'] == $b['distance']) {
                return 0;
            }

            return $a['distance'] < $b['distance'] ? -1 : 1;
        });

        return array_map(function ($element) {
            return $element['point'];
        }, $pointsAndDistances);
    }

    /**
     * Filters points that are within $radius km radius of a given $centerPoint
     *
     * @param GeoPointInterface   $centerPoint
     * @param GeoPointInterface[] $points
     * @param float               $radius
     *
     * @return array
     */
    public function filterPointsWithinRadius(GeoPointInterface $centerPoint, $points, $radius)
    {
        $result = array();
        foreach ($points as $point) {
            if (!$point instanceof GeoPointInterface) {
                continue;
            }

            $distance = $this->getDistanceBetweenPoints($centerPoint, $point);

            if ($distance > $radius) {
                continue;
            }

            $result[] = $point;
        }

        return $result;
    }

    /**
     * Calculates the distance between two points in kilometres
     *
     * @param GeoPointInterface $point1
     * @param GeoPointInterface $point2
     *
     * @see https://inkplant.com/code/calculate-the-distance-between-two-points
     *
     * @return float
     */
    public function getDistanceBetweenPoints(GeoPointInterface $point1, GeoPointInterface $point2)
    {
        $latitude1 = $point1->getLatitude();
        $longitude1 = $point1->getLongitude();
        $latitude2 = $point2->getLatitude();
        $longitude2 = $point2->getLongitude();

        $theta = $longitude1 - $longitude2;
        $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2)))
            + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $kilometers = $miles * 1.609344;

        return $kilometers;
    }
}
