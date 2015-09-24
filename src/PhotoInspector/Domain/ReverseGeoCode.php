<?php

namespace PhotoInspector\Domain;

class ReverseGeoCode
{
    private $street_address;
    private $neighborhood;
    private $sub_locality;
    private $locality;
    private $postal_code;
    private $admin_area_2;
    private $admin_area_1;
    private $country;

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
}
