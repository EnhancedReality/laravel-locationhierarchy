<?php

namespace EnhancedReality\LocationHierarchy\Test;

use EnhancedReality\LocationHierarchy\Test\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use EnhancedReality\LocationHierarchy\{Community,Municipality,Region,LocationServiceProvider};

class LocationTest extends TestCase
{
    public function test_it_can_create_locations()
    {
        $westfarthing = Region::create(['name'=>'West Farthing']);
        $this->assertCount(1,Region::all());

        $hobbitton = Municipality::createIn($westfarthing,'Hobbitton');
        $bywater = Municipality::createIn($westfarthing,'Bywater');
        $this->assertCount(2,Municipality::all());

        $underhill = Community::createIn($hobbitton,'Underhill');
        $this->assertCount(1,Community::all());
        
        $this->assertEquals($hobbitton->id,$westfarthing->children()->first()->id);
        $this->assertEquals($hobbitton->id,$underhill->parent()->id);
    }
}