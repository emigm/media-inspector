<?php

namespace MediaInspector\Domain;

use MediaInspector\Domain;

interface iReverseGeoCode
{
    public function getReverseGeoCode(Domain\GeoPoint $location);
}
