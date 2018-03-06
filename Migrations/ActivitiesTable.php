<?php

namespace Migrations;

class ActivitiesTable
{
    public static function up ($schema)
    {
        $schema->create('activities', function ($table) {
            $table->increments('activity_id');
            $table->integer('type_id')->unsigned()->nullable();
            $table->string('parent_type', 255)->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('name', 255);
            $table->text('value');
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('activities');
    }

}
