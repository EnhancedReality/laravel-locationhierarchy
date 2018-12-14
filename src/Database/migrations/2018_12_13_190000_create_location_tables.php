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
        HierarchicalTableHelper::buildTable('communities','municipalities');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }

}
