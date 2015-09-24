<?php

namespace PhotoInspector\UnitTests;

use PhotoInspector\Utils;

class GeoPointTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateGeoPoint()
    {
        $LATITUDE = 40.733497;
        $LONGITUDE = -74.058645;

        $geo_point = new Utils\GeoPoint($LATITUDE, $LONGITUDE);

        $this->assertEquals($geo_point->getLatitude(), $LATITUDE);
        $this->assertEquals($geo_point->getLongitude(), $LONGITUDE);
    }

    /**
     * @expectedException           InvalidArgumentException 
     * @expectedExceptionMessage    Latitude out of bounds
     */
    public function testInvalidLatitude()
    {
        $LATITUDE = 91.0;
        $LONGITUDE = -74.058645;

        $geo_point = new Utils\GeoPoint($LATITUDE, $LONGITUDE);
    }

    /**
     * @expectedException           InvalidArgumentException 
     * @expectedExceptionMessage    Longitude out of bounds
     */
    public function testInvalidLongitude()
    {
        $LATITUDE = 91.0;
        $LONGITUDE = -74.058645;

        $geo_point = new Utils\GeoPoint($LATITUDE, $LONGITUDE);
    }

}
