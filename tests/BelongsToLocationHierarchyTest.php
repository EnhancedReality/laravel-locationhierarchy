<?php

namespace EnhancedReality\LocationHierarchy\Test;

use EnhancedReality\LocationHierarchy\Test\TestCase;
use EnhancedReality\LocationHierarchy\Test\Mock\ModelMock;
use EnhancedReality\LocationHierarchy\Traits\BelongsToLocationHierarchy;

use Illuminate\Foundation\Testing\RefreshDatabase;

use EnhancedReality\LocationHierarchy\{Community,Municipality,MunicipalityDistrict,Region,LocationServiceProvider};

class BelongsToLocationHierarchyTest extends TestCase
{
    public function test_it_belongs_to_locations()
    {
        $mock = new ModelMock();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $mock->region());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $mock->municipality());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $mock->municipalityDistrict());
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $mock->community());
    }

}