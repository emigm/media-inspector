<?php

namespace MediaInspector\Domain;

class ReverseGeoCode
{
    private $street_address = NULL;
    private $neighborhood = NULL;
    private $sub_locality = NULL;
    private $locality = NULL;
    private $postal_code = NULL;
    private $admin_area_2 = NULL;
    private $admin_area_1 = NULL;
    private $country = NULL;

    function __construct(
        $street_address, $neighborhood, $sub_locality, $locality, $postal_code,
        $admin_area_2, $admin_area_1, $country)
    {
        $this->street_address = $street_address;
        $this->neighborhood = $neighborhood;
        $this->sub_locality = $sub_locality;
        $this->locality = $locality;
        $this->postal_code = $postal_code;
        $this->admin_area_2 = $admin_area_2;
        $this->admin_area_1 = $admin_area_1;
        $this->country = $country;
    }

    public function getStreetAddress()
    {
        return $this->street_address;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getAdminArea1()
    {
        return $this->admin_area_1;
    }

    public function getAdminArea2()
    {
        return $this->admin_area_2;
    }

    public function getSubLocality()
    {
        return $this->sub_locality;
    }

    public function getLocality()
    {
        return $this->locality;
    }

    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    public function getPostalCode()
    {
        return $this->postal_code;
    }

    public function toArray()
    {
        $array['streetAddress'] = $this->street_address;
        $array['neighborhood'] = $this->neighborhood;
        $array['subLocality'] = $this->sub_locality;
        $array['locality'] = $this->locality;
        $array['postalCode'] = $this->postal_code;
        $array['adminArea1'] = $this->admin_area_2;
        $array['adminArea2'] = $this->admin_area_1;
        $array['country'] = $this->country;

        return $array;
    }
}
