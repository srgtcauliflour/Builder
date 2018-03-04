<?php

namespace Migrations;

class PostsModulesTable
{
    public static function up ($schema)
    {
        $schema->create('posts_modules', function ($table) {
            $table->increments('post_module_id');
            $table->integer('post_id')->unsigned();
            $table->integer('module_id')->unsigned();
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('posts_modules');
    }

}
