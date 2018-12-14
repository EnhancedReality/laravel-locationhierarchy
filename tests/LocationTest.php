<?php

namespace EnhancedReality\LocationHierarchy\Test;

use EnhancedReality\LocationHierarchy\Test\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use EnhancedReality\LocationHierarchy\{Community,Municipality,Region,LocationServiceProvider};

class LocationTest extends TestCase
{
    public function test_it_can_create_locations()
    {
        $shire = Region::create(['name'=>'The Shire']);
        $this->assertCount(1,Region::all());

        $hobbitton = Municipality::createIn($shire,'Hobbitton');
        $this->assertCount(1,Municipality::all());

        $underhill = Community::createIn($hobbitton,'Underhill');
        $this->assertCount(1,Community::all());
        
        $this->assertEquals($hobbitton->id,$shire->children()->first()->id);
        $this->assertEquals($hobbitton->id,$underhill->parent()->id);
    }
}