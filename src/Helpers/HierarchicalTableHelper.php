<?php

namespace EnhancedReality\LocationHierarchy\Helpers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class HierarchicalTableHelper
{
    public static function buildTable(string $tableName, string $parentTableName = null)
    {
        Schema::create($tableName, function (Blueprint $table) use ($parentTableName) {
            $table->increments('id');
            $table->string('name',100);

            if (isset($parentTableName)) {
                $table->integer('parent_id')->unsigned();
                $table->foreign('parent_id')->references('id')->on($parentTableName)->onDelete('CASCADE');
            }

            $table->timestamps();
        });
    }
}