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

    public function test_it_has_query_scopes()
    {
        $bagEnd = new ModelMock();

        $westfarthing = Region::create(['name'=>'West Farthing']);
        $hobbitton = Municipality::createIn($westfarthing,'Hobbitton');
        $underhill = MunicipalityDistrict::createIn($hobbitton,'Underhill');
        $bagshotrow = Community::createIn($underhill,'Bagshot Row');

        $bagEnd->region()->associate($westfarthing);
        $bagEnd->municipality()->associate($hobbitton);
        $bagEnd->municipalityDistrict()->associate($underhill);
        $bagEnd->community()->associate($bagshotrow);
        $bagEnd->save();

        // Property in another community
        $pennyLane = Community::createIn($underhill,'Penny Lane');
        $greenDragonInn = new ModelMock();
        
        $greenDragonInn->region()->associate($westfarthing);
        $greenDragonInn->municipality()->associate($hobbitton);
        $greenDragonInn->municipalityDistrict()->associate($underhill);
        $greenDragonInn->community()->associate($pennyLane);
        $greenDragonInn->save();        

        $this->assertCount(2,ModelMock::all());

        // Filtered
        $this->assertCount(1,ModelMock::inCommunity($pennyLane->name)->get());
        $this->assertCount(1,ModelMock::inCommunity($bagshotrow->name)->get());
        $this->assertEquals($greenDragonInn->id,ModelMock::inCommunity($pennyLane->name)->first()->id);
        $this->assertEquals($bagEnd->id,ModelMock::inCommunity($bagshotrow->name)->first()->id);

        // Scopes exist
        $this->assertCount(2,ModelMock::inMunicipalityDistrict($underhill->name)->get());
        $this->assertCount(2,ModelMock::inMunicipality($hobbitton->name)->get());
        $this->assertCount(2,ModelMock::inRegion($westfarthing->name)->get());

        // Chaining scopes
        $query = ModelMock::inRegion($westfarthing->name)
            ->inMunicipality($hobbitton->name)
            ->inMunicipalityDistrict($underhill->name)
            ->inCommunity($pennyLane->name);

        $this->assertEquals($greenDragonInn->id,$query->first()->id);

    }

}