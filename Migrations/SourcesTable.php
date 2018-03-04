<?php

namespace Migrations;

class SourcesTable
{
    public static function up ($schema)
    {
        $schema->create('sources', function ($table) {
            $table->increments('source_id');
            $table->integer('type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name', 255);
            $table->text('desc');
            $table->integer('size')->unsigned();
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('sources');
    }

}
