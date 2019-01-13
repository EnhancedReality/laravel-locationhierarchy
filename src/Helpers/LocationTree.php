<?php

namespace EnhancedReality\LocationHierarchy\Helpers;

use EnhancedReality\LocationHierarchy\{Community,Municipality,MunicipalityDistrict,Region};

class LocationTree
{
    protected $valid = true;
    protected $params = [];

    public $region;
    public $municipality;
    public $municipalityDistrict;
    public $community;
    
    function __construct (array $params)
    {       
        $this->params = $params;
    }

    public static function make(array $locationNames) : self
    {
        return (new static($locationNames))
            ->isSet('region')
            ->isSet('municipality')
            ->isSet('municipality_district')
            ->isSet('community')
            ->firstOrCreateLocations();
    }

    public function valid() : bool
    {
        return $this->valid;
    }

    protected function isSet(string $key) : self
    {
        $conditionValid = isset($this->params[$key]) && !empty($this->params[$key]);
        $this->valid = $this->valid && $conditionValid;

        return $this;
    }

    protected function firstOrCreateLocations() : self
    {
        if ($this->valid) {
            $this->region = Region::firstOrCreate(['name'=>$this->params['region']]);
            $this->municipality = Municipality::createIn($this->region,$this->params['municipality']);
            $this->municipalityDistrict = MunicipalityDistrict::createIn($this->municipality,$this->params['municipality_district']);
            $this->community = Community::createIn($this->municipalityDistrict,$this->params['community']);
        }

        return $this;
    }
}