<?php

namespace Migrations;

class SitesTable
{
    public static function up ($schema)
    {
        $schema->create('sites', function ($table) {
            $table->increments('site_id');
            $table->integer('type_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name', 255);
            $table->text('content');
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('sites');
    }

}
