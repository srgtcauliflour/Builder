<?php

namespace Migrations;

class ZZRelations
{

    public static function up($schema)
    {
        /**
         * users
         */
        $schema->table('users', function ($table) {
            $table
                ->foreign('type_id')
                ->references('type_id')
                ->on('types');
        });

        /**
         * Settings
         */
        $schema->table('settings', function ($table) {
            $table
                ->foreign('user_id')
                ->references('user_id')
                ->on('users');
            
            $table
                ->foreign('type_id')
                ->references('type_id')
                ->on('types');
        });

        /**
         * Activies
         */
        $schema->table('activities', function ($table) {
            $table
                ->foreign('type_id')
                ->references('type_id')
                ->on('types');
        });

        /**
         * Sources
         */
        $schema->table('sources', function ($table) {
            $table
                ->foreign('type_id')
                ->references('type_id')
                ->on('types');

            $table
                ->foreign('user_id')
                ->references('user_id')
                ->on('users');
        });

        /**
         * Posts
         */
        $schema->table('posts', function ($table) {
            $table
                ->foreign('type_id')
                ->references('type_id')
                ->on('types');
            
            $table
                ->foreign('site_id')
                ->references('site_id')
                ->on('sites');
            
            $table
                ->foreign('module_id')
                ->references('module_id')
                ->on('modules');
        });

        /**
         * Sites
         */
        $schema->table('sites', function ($table) {
            $table
                ->foreign('type_id')
                ->references('type_id')
                ->on('types');

            $table
                ->foreign('user_id')
                ->references('user_id')
                ->on('users');
        });

        /**
         * Modules
         */
        $schema->table('modules', function ($table) {
            $table
                ->foreign('type_id')
                ->references('type_id')
                ->on('types');
        });

        /**
         * Post Modules
         */
        $schema->table('posts_modules', function ($table) {
            $table
                ->foreign('post_id')
                ->references('post_id')
                ->on('posts');

            $table
                ->foreign('module_id')
                ->references('module_id')
                ->on('modules');
        });
    }

    public static function down($schema)
    {
        /**
         * Users
         */
        $schema->table('users', function ($table) {
            $table->dropForeign('users_type_id_foreign');
        });

        /**
         * Settings
         */
        $schema->table('settings', function ($table) {
            $table->dropForeign('settings_user_id_foreign');
            $table->dropForeign('settings_type_id_foreign');
        });

        /**
         * Activities
         */
        $schema->table('activities', function ($table) {
            $table->dropForeign('activities_type_id_foreign');
        });

        /**
         * Sources
         */
        $schema->table('sources', function ($table) {
            $table->dropForeign('sources_type_id_foreign');
            $table->dropForeign('sources_user_id_foreign');
        });

        /**
         * Posts
         */
        $schema->table('posts', function ($table) {
            $table->dropForeign('posts_type_id_foreign');
            $table->dropForeign('posts_site_id_foreign');
            $table->dropForeign('posts_module_id_foreign');
        });

        /**
         * Sites
         */
        $schema->table('sites', function ($table) {
            $table->dropForeign('sites_type_id_foreign');
            $table->dropForeign('sites_user_id_foreign');
        });

        /**
         * Modules
         */
        $schema->table('modules', function ($table) {
            $table->dropForeign('modules_type_id_foreign');
        });

        /**
         * Post Modules
         */
        $schema->table('posts_modules', function ($table) {
            $table->dropForeign('posts_modules_post_id_foreign');
            $table->dropForeign('posts_modules_module_id_foreign');
        });
    }
}
