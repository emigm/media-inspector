<?php

namespace PhotoInspector\Domain;

interface iMediaInfo
{
    public function getMediaInfo($access_token, $media_id);
}
