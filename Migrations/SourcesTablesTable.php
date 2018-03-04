<?php

namespace Migrations;

class SourcesTablesTable
{
    public static function up ($schema)
    {
        $schema->create('sources_tables', function ($table) {
            $table->increments('source_table_id');
            $table->string('parent_type', 255);
            $table->integer('parent_id')->unsigned();
            $table->integer('source_id')->unsigned();
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('sources_tables');
    }

}
