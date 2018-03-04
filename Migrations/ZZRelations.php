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
            $table->dropForeign('activies_type_id_foreign');
        });
    }
}
