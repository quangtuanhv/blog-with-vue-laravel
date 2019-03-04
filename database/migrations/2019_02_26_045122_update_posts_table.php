<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('user_id')->after('published');
            $table->integer('number_of_comments')->after('user_id');
            $table->integer('number_of_likes')->after('number_of_comments');
            $table->string('avatar_post')->after('number_of_likes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('user_id');
            $table->dropColumn('number_of_comments');
            $table->dropColumn('number_of_likes');
            $table->dropColumn('avatar_post');
        });
    }
}
