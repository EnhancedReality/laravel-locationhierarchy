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

}
