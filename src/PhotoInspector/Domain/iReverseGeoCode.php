<?php

namespace PhotoInspector\Domain;

use PhotoInspector\Utils;

interface iReverseGeoCode
{
    public function getReverseGeoCode($api_key, Utils\GeoPoint $location);
}
