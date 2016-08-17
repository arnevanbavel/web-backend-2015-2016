<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('artikel_id')->unsigned();
            $table->string('comment');
            $table->integer('user_id')->unsigned();
            $table->softDeletes(); // this adds 'deleted_at' column in the Users table
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('artikel_id')->references('id')->on('artikels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments', function(Blueprint $table) {
            $table->dropForeign('comments_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('comments_artikel_id_foreign');
            $table->dropColumn('artikel_id');
        });
    }
}
