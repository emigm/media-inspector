<?php

namespace PhotoInspector\Utils;

class GeoPoint
{
    private $latitude = NULL;
    private $longitude = NULL;

    public function __construct($latitude, $longitude)
    {
        if ($latitude < -90.0 or $latitude > 90.0) {
            throw new \InvalidArgumentException('Latitude out of bounds');
        } elseif ($longitude < -180.0 or $longitude > 180.0) {
            throw new \InvalidArgumentException('Longitude out of bounds');
        } else {
            $this->latitude = $latitude;
            $this->longitude = $longitude;
        }
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function toArray()
    {
        $array['latitude'] = $this->latitude;
        $array['longitude'] = $this->longitude;

        return $array;
    }
}
