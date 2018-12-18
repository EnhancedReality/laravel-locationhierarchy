<?php

namespace EnhancedReality\LocationHierarchy\Test\Mock;
use EnhancedReality\LocationHierarchy\Traits\BelongsToLocationHierarchy;

use Illuminate\Database\Eloquent\Model;

class ModelMock extends Model
{
    use BelongsToLocationHierarchy;
}