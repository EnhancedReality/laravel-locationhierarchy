<?php

namespace EnhancedReality\LocationHierarchy;

use EnhancedReality\LocationHierarchy\Location;

class Region extends Location
{
    protected static $parentClass = Province::class;
    protected static $childClass = Municipality::class;
}
