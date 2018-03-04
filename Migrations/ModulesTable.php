<?php

namespace Migrations;

class ModulesTable
{
    public static function up ($schema)
    {
        $schema->create('modules', function ($table) {
            $table->increments('module_id');
            $table->integer('type_id')->unsigned();
            $table->string('name', 255);
            $table->text('desc');
            $table->string('repo', 255);
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('modules');
    }

}
