<?php

namespace MediaInspector\UnitTests;

use MediaInspector\Instagram;
use MediaInspector\Utils;

class MediaTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateMediaInfoWithLocation()
    {
        $LATITUDE = 40.733497;
        $LONGITUDE = -74.058645;

        $geo_point = new Utils\GeoPoint($LATITUDE, $LONGITUDE);

        $ID = 'media123';
        $TYPE = 'photo';

        $media_info = new Instagram\Media($ID, $TYPE, $geo_point);

        $this->assertEquals($ID, $media_info->getId());
        $this->assertEquals($TYPE, $media_info->getType());
        $this->assertEquals($geo_point, $media_info->getGeoPoint());
    }

    public function testCreateMediaInfoWithoutLocation()
    {
        $ID = 'media123';
        $TYPE = 'photo';

        $media_info = new Instagram\Media($ID, $TYPE);

        $this->assertEquals($ID, $media_info->getId());
        $this->assertEquals($TYPE, $media_info->getType());
    }
}
