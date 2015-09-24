<?php

namespace PhotoInspector\Domain;

use PhotoInspector\Utils;

interface iReverseGeoCode
{
    public function getReverseGeoCode(Utils\GeoPoint $location);
}
