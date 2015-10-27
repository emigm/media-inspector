<?php

namespace MediaInspector\Instagram;

use MediaInspector\Domain;

class Media
{
    private $id = NULL;
    private $geo_point = NULL;
    private $type = NULL;

    public function __construct($id, $type, Domain\GeoPoint $geo_point = NULL)
    {
        $this->id = $id;
        $this->type = $type;
        $this->geo_point = $geo_point;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getGeoPoint()
    {
        return $this->geo_point;
    }

    public function toArray()
    {
        $array['id'] = $this->id;
        $array['type'] = $this->type;
        $array['geoPoint'] = $this->geo_point->toArray();

        return $array;
    }
}
