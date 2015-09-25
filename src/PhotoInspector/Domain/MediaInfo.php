<?php

namespace PhotoInspector\Domain;

use PhotoInspector\Utils;

class MediaInfo 
{
    private $id = NULL;
    private $geo_point = NULL;
    private $name = NULL;
    private $reverse_geo_code = NULL;
    private $type = NULL;

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

    public function toArray()
    {
        $array['id'] = $this->id;
        $array['type'] = $this->type;
        $array['location']['geoPoint'] = $this->geo_point->toArray();
        $array['location']['reverseGeoCode'] = $this->reverse_geo_code->toArray();

        return $array;
    }
}
