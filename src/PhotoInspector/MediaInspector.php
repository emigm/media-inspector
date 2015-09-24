<?php

namespace PhotoInspector;

use PhotoInspector\Domain
use PhotoInspector\Google;
use PhotoInspector\Instagram;

class MediaInspector 
{
    const API_KEY = 'AIzaSyAJZS9xjpoN_CT7__iaqsxflGleHgL4QhA';
    const ACCESS_TOKEN = '37946071.de0b35a.4ad6041a05454637ad4f04f80f530841';

    function __construct(Domain\iMediaInfo media_inspector, Domain\iReverseGeoCode geo_coder)
    {
        $this->geo_coder = $geo_coder;
        $this->media_inspector = $media_inspector;        
    }

    public function getMediaMetadata($media_id)
    {
        try {
            $media_info = $this->media_inspector->getMediaInfo(
                self::ACCESS_TOKEN, $media_id);
            $reverse_geo_code = $this->geo_coder->getReverseGeoCode(
                self::API_KEY, $media_info->getLocation());
        } catch (\Exception $ex) {

        }


    }
}
