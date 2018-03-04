<?php

namespace Migrations;

class SettingsTable
{
    public static $table = 'settings';

    public static function up($schema)
    {
        $schema->create('settings', function ($table) {
            $table->increments('setting_id');
            $table->integer('user_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('name', 255);
            $table->text('value');
            $table->timestamps();
        });
    }

    public static function down($schema)
    {
        $schema->dropIfExists('settings');
    }
}
