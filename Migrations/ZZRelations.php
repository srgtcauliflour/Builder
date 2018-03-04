<?php

namespace Migrations;

class ZZRelations
{

    public static function up($schema)
    {
        $schema->table('users', function ($table) {
            $table
                ->foreign('type_id')
                ->references('type_id')
                ->on('types');
        });

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
    }

    public static function down($schema)
    {
        $schema->table('users', function ($table) {
            $table->dropForeign('users_type_id_foreign');
        });

        $schema->table('settings', function ($table) {
            $table->dropForeign('settings_user_id_foreign');
            $table->dropForeign('settings_type_id_foreign');
        });
    }
}
