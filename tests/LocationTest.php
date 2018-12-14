<?php

namespace EnhancedReality\LocationHierarchy\Test;

use EnhancedReality\LocationHierarchy\Test\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use EnhancedReality\LocationHierarchy\{Community,Municipality,Region,LocationServiceProvider};

class LocationTest extends TestCase
{
    public function test_it_can_create_locations()
    {
        $this->assertCount(0,Region::all());
        // $this->assertCount(0,Municipality::all());
        // $this->assertCount(0,Community::all());
    }
}