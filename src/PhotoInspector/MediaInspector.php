<?php

namespace PhotoInspector;

use PhotoInspector\Domain;

class MediaInspector 
{
    function __construct(Domain\iMedia $media_endpoint, Domain\iReverseGeoCode $maps)
    {
        $this->maps = $maps;
        $this->media_endpoint = $media_endpoint;        
    }

    public function getMediaInfo($media_id)
    {
        $media = $this->media_endpoint->getMedia($media_id);
        $reverse_geo_code = $this->maps->getReverseGeoCode($media->getGeoPoint());

        $media_info = new Domain\MediaInfo(
            $media->getId(), $media->getType(), $media->getGeoPoint(),
            $reverse_geo_code);

        return $media_info;
    }
}
