<?php

namespace EnhancedReality\LocationHierarchy\Traits;

use  Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToLocationHierarchy {

    public function region() : BelongsTo
    {
        return $this->belongsTo('EnhancedReality\LocationHierarchy\Region');
    }

    public function municipality() : BelongsTo
    {
        return $this->belongsTo('EnhancedReality\LocationHierarchy\Municipality');
    }

    public function municipalityDistrict() : BelongsTo
    {
        return $this->belongsTo('EnhancedReality\LocationHierarchy\MunicipalityDistrict');
    }

    public function community()
    {
        return $this->belongsTo('EnhancedReality\LocationHierarchy\Community');
    }

    /* 
        Scopes
    */
    public function scopeInCommunity($query,$name)
    {
        return $this->inLocationQuery($query,$name,'communities','community');
    }

    public function scopeInMunicipalityDistrict($query,$name)
    {
        return $this->inLocationQuery($query,$name,'municipality_districts','municipality_district');
    }

    public function scopeInMunicipality($query,$name)
    {
        return $this->inLocationQuery($query,$name,'municipalities','municipality');
    }

    public function scopeInRegion($query,$name)
    {
        return $this->inLocationQuery($query,$name,'regions','region');
    }    

    protected function inLocationQuery($query, $name, string $locationTable, string $locationSingular)
    {
        return $query->join($locationTable, function ($join) use($name, $locationTable, $locationSingular) {
            $join->on("{$this->getTable()}.{$locationSingular}_id", '=', "{$locationTable}.id")
                 ->where("{$locationTable}.name", '=', $name);
        });
    }
}
