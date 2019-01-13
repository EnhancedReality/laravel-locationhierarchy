<?php

namespace EnhancedReality\LocationHierarchy\Test;

use EnhancedReality\LocationHierarchy\Test\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

use EnhancedReality\LocationHierarchy\{Community,Municipality,MunicipalityDistrict,Region,LocationServiceProvider};
use EnhancedReality\LocationHierarchy\Helpers\LocationTree;

class LocationTest extends TestCase
{
    public function test_it_can_create_locations()
    {
        $westfarthing = Region::create(['name'=>'West Farthing']);
        $this->assertCount(1,Region::all());

        $hobbitton = Municipality::createIn($westfarthing,'Hobbitton');
        $bywater = Municipality::createIn($westfarthing,'Bywater');
        $this->assertCount(2,Municipality::all());

        $underhill = MunicipalityDistrict::createIn($hobbitton,'Underhill');
        $this->assertCount(1,MunicipalityDistrict::all());

        $bagshotrow = Community::createIn($underhill,'Bagshot Row');

        $this->assertCount(1,Community::all());
        
        $this->assertEquals($hobbitton->id,$westfarthing->children()->first()->id);
        $this->assertEquals($underhill->id,$bagshotrow->parent()->id);
    }

    public function test_it_can_throw_exceptions_when_given_invalid_parent_class()
    {
        $region = Region::create(['name'=>'West Farthing']);
        $municipality = Municipality::createIn($region,'Hobbitton');
        $municipalityDistrict = MunicipalityDistrict::createIn($municipality,'Underhill');

        // Communities must be created in Municipality Districts.
        $this->expectException(\InvalidArgumentException::class);
        $community = Community::createIn($municipality,'Maggot\'s Farm');
    }

    public function test_it_can_make_location_tree()
    {
        $locationTree = LocationTree::make([
            'region' => 'West Farthing',
            'municipality' => 'Bywater',
            'municipality_district' => 'Underhill',
            'community' => 'Bagshot Row'
        ]);

        $this->assertTrue($locationTree->valid());

        $this->assertEquals(MunicipalityDistrict::first()->name,$locationTree->municipalityDistrict->name);

        // Missing info
        $locationTree = LocationTree::make([
            'region' => 'West Farthing',
            'municipality' => '',
            'municipality_district' => 'Underhill',
            'community' => 'Bagshot Row'
        ]);

        $this->assertFalse($locationTree->valid());
    }
}