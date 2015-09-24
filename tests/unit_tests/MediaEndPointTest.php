<?php

namespace PhotoInspector\UnitTests;

use PhotoInspector\Domain;
use PhotoInspector\Instagram;
use PhotoInspector\Utils;

class MediaEndPointTest extends \PHPUnit_Framework_TestCase
{
    const RESPONSE_WITH_LOCATION = "{\"meta\":{\"code\":200},\"data\":{\"attribution\":null,\"tags\":[\"markehattan\"],\"type\":\"image\",\"location\":{\"latitude\":40.7155418,\"name\":\"Best Pizza Williamsburg\",\"longitude\":-73.9533691,\"id\":223592123},\"comments\":{\"count\":0,\"data\":[]},\"filter\":\"Nashville\",\"created_time\":\"1443126746\",\"link\":\"https://instagram.com/p/8BuELpIi0C/\",\"likes\":{\"count\":0,\"data\":[]},\"images\":{\"low_resolution\":{\"url\":\"https://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/s320x320/e35/12063020_1095252193827218_1138981046_n.jpg\",\"width\":320,\"height\":320},\"thumbnail\":{\"url\":\"https://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/s150x150/e35/12063020_1095252193827218_1138981046_n.jpg\",\"width\":150,\"height\":150},\"standard_resolution\":{\"url\":\"https://scontent.cdninstagram.com/hphotos-xfa1/t51.2885-15/s640x640/sh0.08/e35/12063020_1095252193827218_1138981046_n.jpg\",\"width\":640,\"height\":640}},\"users_in_photo\":[],\"caption\":{\"created_time\":\"1443126746\",\"text\":\"carb loading after biking through bklyn #markehattan\",\"from\":{\"username\":\"jessie_duell\",\"profile_picture\":\"https://igcdn-photos-b-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/11326661_385164575024545_1070638364_a.jpg\",\"id\":\"1220832186\",\"full_name\":\"j e s s i e    d u e l l\"},\"id\":\"1081347985815777073\"},\"user_has_liked\":false,\"id\":\"1081347983064313090_1220832186\",\"user\":{\"username\":\"jessie_duell\",\"profile_picture\":\"https://igcdn-photos-b-a.akamaihd.net/hphotos-ak-xfa1/t51.2885-19/11326661_385164575024545_1070638364_a.jpg\",\"id\":\"1220832186\",\"full_name\":\"j e s s i e    d u e l l\"}}}";
    const RESPONSE_WITHOUT_LOCATION = "{\"meta\":{\"code\":200},\"data\":{\"attribution\":null,\"tags\":[\"lasvegas\",\"bellagio\"],\"type\": \"image\",\"location\":null,\"comments\":{\"count\":1,\"data\":[{\"created_time\":\"1323841318\",\"text\":\"Can't go wrong with penguins!\",\"from\":{\"username\":\"dantax\",\"profile_picture\": \"https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/11821846_1472631506391080_788481119_a.jpg\",\"id\":\"13024258\",\"full_name\":\"Simon Thornton\"},\"id\":\"531287441\"}]},\"filter\":\"Toaster\",\"created_time\":\"1323838561\",\"link\":\"https://instagram.com/p/ZCd4K/\",\"likes\":{\"count\":6,\"data\":[{\"username\":\"rodrigocdg\",\"profile_picture\":\"https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-19/11358931_387636098107297_921630946_a.jpg\",\"id\":\"1430577\",\"full_name\":\"Rodrigo\"},{\"username\":\"dantax\",\"profile_picture\":\"https://igcdn-photos-a-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/11821846_1472631506391080_788481119_a.jpg\",\"id\":\"13024258\",\"full_name\":\"Simon Thornton\"},{\"username\":\"archivodemialma\",\"profile_picture\":\"https://igcdn-photos-e-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/11351605_1659769907593756_481180149_a.jpg\",\"id\":\"2249350\",\"full_name\":\"\"},{\"username\":\"robotic_nerve\",\"profile_picture\":\"https://scontent.cdninstagram.com/hphotos-xaf1/t51.2885-19/s150x150/11375391_515890241892385_1799338737_a.jpg\",\"id\":\"4554433\",\"full_name\":\"Andrew\"}]},\"images\":{\"low_resolution\":{\"url\":\"https://scontent.cdninstagram.com/hphotos-xtp1/t51.2885-15/s320x320/e15/11142205_1619460198284426_1295204350_n.jpg\",\"width\":320,\"height\":320},\"thumbnail\":{\"url\":\"https://scontent.cdninstagram.com/hphotos-xtp1/t51.2885-15/s150x150/e15/11142205_1619460198284426_1295204350_n.jpg\",\"width\":150,\"height\":150},\"standard_resolution\":{\"url\":\"https://scontent.cdninstagram.com/hphotos-xtp1/t51.2885-15/e15/11142205_1619460198284426_1295204350_n.jpg\",\"width\":612,\"height\":612}},\"users_in_photo\":[],\"caption\":{\"created_time\":\"1323838561\",\"text\":\"#lasvegas #bellagio\",\"from\":{\"username\":\"mflart\",\"profile_picture\":\"https://igcdn-photos-c-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/11428689_1447280178933730_1402542420_a.jpg\",\"id\":\"4190444\",\"full_name\":\"MFLART, Assoc. AIA, ASAI\"},\"id\":\"531148714\"},\"user_has_liked\":false,\"id\":\"420077066_4190444\",\"user\":{\"username\":\"mflart\",\"profile_picture\":\"https://igcdn-photos-c-a.akamaihd.net/hphotos-ak-xaf1/t51.2885-19/11428689_1447280178933730_1402542420_a.jpg\",\"id\": \"4190444\",\"full_name\":\"MFLART, Assoc. AIA, ASAI\"}}}";

    public function testGetMediaWithLocation() {
        $rest_client_stub = $this->getMockBuilder('\PhotoInspector\RESTAdapeter\RESTClient')
                                 ->setMethods(array('get'))
                                 ->getMock();

        $rest_client_stub->expects($this->any())
                         ->method('get')
                         ->will($this->returnValue(self::RESPONSE_WITH_LOCATION));

        $ACCESS_TOKEN = 'access.token.123';
        $media_endpoint = new Instagram\MediaEndPoint($ACCESS_TOKEN, $rest_client_stub);

        $MEDIA_ID = '1081347983064313090';
        $media = $media_endpoint->getMedia($MEDIA_ID);

        $expected_geo_point = new Utils\GeoPoint('40.7155418', '-73.9533691');
        $expected_media = new Instagram\Media(
            '1081347983064313090_1220832186', 'image', $expected_geo_point);

        $this->assertEquals($expected_media, $media);
    }

    public function testGetMediaWithOutLocation() {
        $rest_client_stub = $this->getMockBuilder('\PhotoInspector\RESTAdapeter\RESTClient')
                                 ->setMethods(array('get'))
                                 ->getMock();

        $rest_client_stub->expects($this->any())
                         ->method('get')
                         ->will($this->returnValue(self::RESPONSE_WITHOUT_LOCATION));

        $ACCESS_TOKEN = 'access.token.123';
        $media_endpoint = new Instagram\MediaEndPoint($ACCESS_TOKEN, $rest_client_stub);

        $MEDIA_ID = '420077066';
        $media = $media_endpoint->getMedia($MEDIA_ID);

        $expected_media = new Instagram\Media('420077066_4190444', 'image');

        $this->assertEquals($expected_media, $media);
    }
}
