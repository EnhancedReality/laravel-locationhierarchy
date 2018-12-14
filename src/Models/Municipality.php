<?php

namespace EnhancedReality\LocationHierarchy;

use EnhancedReality\LocationHierarchy\Location;

class Municipality extends Location
{
    protected static $parentClass = Region::class;
    protected static $childClass = Community::class;
}
