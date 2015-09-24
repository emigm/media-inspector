<?php

namespace PhotoInspector\Domain;

use PhotoInspector\Utils;

class MediaInfo 
{
    private $id;
    private $geo_point;
    private $name;
    private $reverse_geo_code;
    private $type;

    public function __construct(
        $id, $type, Utils\GeoPoint $geo_point = NULL,Utils\ReverseGeoCode $reverse_geo_code = NULL)
    {
        $this->id = $id;
        $this->name = NULL; // TODO: Add media name
        $this->type = $type;
        $this->geo_point = $geo_point;
        $this->reverse_geo_code = $reverse_geo_code;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getGeoPoint()
    {
        return $this->geo_point;
    }

    public function getReverseGeoCode()
    {
        return $this->reverse_geo_code;
    }
}
