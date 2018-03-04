<?php

namespace Migrations;

class TypesTable
{
    public static $table = 'types';

    public static function up($schema)
    {
        $schema->create('types', function ($table) {
            $table->increments('type_id');
            $table->string('type', 255);
            $table->string('name', 255)->nullable();
            $table->string('value', 255)->nullable();
            $table->timestamps();
        });
    }

    public static function down($schema)
    {
        $schema->dropIfExists('types');
    }
}
