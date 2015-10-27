<?php

namespace MediaInspector\UnitTests;

use MediaInspector\Domain;

class ReverseGeoCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateReverseGeoCode()
    {
        $STREET_ADDRESS = '277 Bedford Ave, Brooklyn, NY 11211, USA';
        $NEIGHBORHOOD = 'Williamsburg';
        $SUB_LOCALITY = 'Brooklyn';
        $LOCALITY = 'NY';
        $POSTAL_CODE = '11211';
        $ADMIN_AREA_2 = 'Kings County';
        $ADMIN_AREA_1 = 'NY';
        $COUNTRY = 'US';

        $reverse_geo_code = new Domain\ReverseGeoCode(
            $STREET_ADDRESS, $NEIGHBORHOOD, $SUB_LOCALITY, $LOCALITY,
            $POSTAL_CODE, $ADMIN_AREA_2, $ADMIN_AREA_1, $COUNTRY);

        $this->assertEquals($reverse_geo_code->getStreetAddress(), $STREET_ADDRESS);
        $this->assertEquals($reverse_geo_code->getNeighborhood(), $NEIGHBORHOOD);
        $this->assertEquals($reverse_geo_code->getSubLocality(), $SUB_LOCALITY);
        $this->assertEquals($reverse_geo_code->getLocality(), $LOCALITY);
        $this->assertEquals($reverse_geo_code->getPostalCode(), $POSTAL_CODE);
        $this->assertEquals($reverse_geo_code->getAdminArea1(), $ADMIN_AREA_1);
        $this->assertEquals($reverse_geo_code->getAdminArea2(), $ADMIN_AREA_2);
        $this->assertEquals($reverse_geo_code->getCountry(), $COUNTRY);
    }
}
