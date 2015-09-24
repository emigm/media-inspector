<?php

namespace PhotoInspector;

use PhotoInspector\Domain
use PhotoInspector\Google;
use PhotoInspector\Instagram;

class MediaInspector 
{
    function __construct(Domain\iMedia media_endpoint, Domain\iReverseGeoCode geo_coder)
    {
        $this->geo_coder = $geo_coder;
        $this->media_endpoint = $media_endpoint;        
    }

    public function getMediaInfo($media_id)
    {
        $media = $this->media_endpoint->getMedia($media_id);
        $reverse_geo_code = $this->geo_coder->getReverseGeoCode($media->getGeoPoint());

        $media_info = new MediaInfo(
            $media->getId(), $media->getType(), $media->getGeoPoint(),
            $reverse_geo_code);

        return $media_info;
    }
}
