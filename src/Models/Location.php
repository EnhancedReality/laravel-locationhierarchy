<?php

namespace EnhancedReality\LocationHierarchy;

use EnhancedReality\LocationHierarchy\Hierchical;

abstract class Location extends Hierarchical
{
    protected $guarded = [];
    protected $visible = ['id', 'name'];

    public static function createIn(Location $parentLocation, string $key)
    {
        if (!is_a($parentLocation, static::$parentClass)) {
            throw new \InvalidArgumentException('Invalid parent location class. Cannot parent to '  . get_class($parentLocation));
        }
        return static::query()->firstOrCreate(['name' => $key, 'parent_id' => $parentLocation['id']]);
    }

}