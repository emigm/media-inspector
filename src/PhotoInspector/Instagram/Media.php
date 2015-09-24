<?php

namespace PhotoInspector\Instagram;

use PhotoInspector\Utils;

class Media
{
    private $id;
    private $geo_point;
    private $name;
    private $type;

    public function __construct($id, $type, Utils\GeoPoint $geo_point = NULL)
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
}
