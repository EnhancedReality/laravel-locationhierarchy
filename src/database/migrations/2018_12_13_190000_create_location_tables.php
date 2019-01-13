<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use EnhancedReality\LocationHierarchy\Helpers\HierarchicalTableHelper;

class CreateLocationTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        HierarchicalTableHelper::buildTable('regions');
        HierarchicalTableHelper::buildTable('municipalities','regions');
        HierarchicalTableHelper::buildTable('municipality_districts','municipalities');
        HierarchicalTableHelper::buildTable('communities','municipality_districts');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('communities');
        Schema::dropIfExists('municipality_districts');
        Schema::dropIfExists('municipalities');
        Schema::dropIfExists('regions');        
    }

}
