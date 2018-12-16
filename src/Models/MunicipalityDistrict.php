<?php

namespace EnhancedReality\LocationHierarchy;

use EnhancedReality\LocationHierarchy\Location;

class MunicipalityDistrict extends Location
{
    protected static $parentClass = Municipality::class;
    protected static $childClass = Community::class;
}
