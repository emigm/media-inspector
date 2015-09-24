<?php

namespace PhotoInspector\UnitTests;

use PhotoInspector\Domain;
use PhotoInspector\Instagram;
use PhotoInspector\Utils;

class MediaInfoTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateMediaInfoWithLocation()
    {
        $LATITUDE = 40.733497;
        $LONGITUDE = -74.058645;

        $location = new Utils\GeoPoint($LATITUDE, $LONGITUDE);

        $ID = 'media123';
        $TYPE = 'photo';

        $media_info = new Domain\MediaInfo($ID, $TYPE, $location);

        $this->assertEquals($media_info->getId(), $ID);
        $this->assertEquals($media_info->getType(), $TYPE);
        $this->assertEquals($media_info->getLocation(), $location);
    }

    public function testCreateMediaInfoWithoutLocation()
    {
        $ID = 'media123';
        $TYPE = 'photo';

        $media_info = new Domain\MediaInfo($ID, $TYPE);

        $this->assertEquals($media_info->getId(), $ID);
        $this->assertEquals($media_info->getType(), $TYPE);
    }
}
