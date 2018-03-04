<?php

namespace Migrations;

class PostsTable
{
    public static function up ($schema)
    {
        $schema->create('posts', function ($table) {
            $table->increments('post_id');
            $table->integer('site_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('module_id')->unsigned()->nullable();
            $table->string('parent_type', 255)->nullable();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->tinyInteger('is_active');
            $table->timestamps();
        });
    }

    public static function down ($schema)
    {
        $schema->dropIfExists('posts');
    }

}
