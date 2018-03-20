<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table->foreign('type_id')->references('type_id')->on('types');
        });

        Schema::table('activities', function ($table) {
            $table->foreign('type_id')->references('type_id')->on('types');
        });

        Schema::table('posts', function ($table) {
            $table->foreign('type_id')->references('type_id')->on('types');
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('site_id')->references('site_id')->on('sites');
        });

        Schema::table('components', function ($table) {
            $table->foreign('type_id')->references('type_id')->on('types');
            $table->foreign('site_id')->references('site_id')->on('sites');
        });

        Schema::table('components_posts', function ($table) {
            $table->foreign('post_id')->references('post_id')->on('posts');
            $table->foreign('component_id')->references('component_id')->on('components');
        });

        Schema::table('sites', function ($table) {
            $table->foreign('type_id')->references('type_id')->on('types');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('components_posts', function ($table) {
            $table->dropForeign('components_posts_post_id_foreign');
            $table->dropForeign('components_posts_component_id_foreign');
        });

        Schema::table('components', function ($table) {
            $table->dropForeign('components_type_id_foreign');
            $table->dropForeign('components_site_id_foreign');
        });

        Schema::table('posts', function ($table) {
            $table->dropForeign('posts_type_id_foreign');
            $table->dropForeign('posts_user_id_foreign');
            $table->dropForeign('posts_site_id_foreign');
        });

        Schema::table('sites', function ($table) {
            $table->dropForeign('sites_type_id_foreign');
            $table->dropForeign('sites_user_id_foreign');
        });

        Schema::table('users', function ($table) {
            $table->dropForeign('users_type_id_foreign');
        });

        Schema::table('activities', function ($table) {
            $table->dropForeign('activities_type_id_foreign');
        });

    }
}
