<?php

namespace PhotoInspector\Domain;

use PhotoInspector\Utils;

class MediaInfo 
{
    private $id;
    private $location;
    private $name;
    private $type;

    public function __construct($id, $type, Utils\GeoPoint $location = NULL)
    {
        $this->id = $id;
        $this->type = $type;
        $this->location = $location;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
