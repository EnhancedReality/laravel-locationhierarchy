<?php

namespace EnhancedReality\LocationHierarchy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class Hierarchical extends Model
{
    protected static $parentClass;
    protected static $childClass;

    public function parent()
    {
        return static::$parentClass::find($this->parent_id);
    }

    public function siblings()
    {
        return static::where('parent_id','=',$this->parent_id);
    }

    public function children()
    {
        return static::$childClass::where('parent_id','=',$this->id);
    }

    public static function named(String $name)
    {
        return static::where('name','like', $name)->first();
    }
}