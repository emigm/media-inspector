<?php

namespace MediaInspector\Domain;

use MediaInspector\Utils;

interface iReverseGeoCode
{
    public function getReverseGeoCode(Utils\GeoPoint $location);
}
