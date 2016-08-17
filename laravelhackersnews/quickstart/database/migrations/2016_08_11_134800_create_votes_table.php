<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('artikel_id')->unsigned();
            $table->boolean('up')->default(true);
            $table->boolean('down')->default(true);
            $table->boolean('algeklikt')->default(false);
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
        Schema::drop('votes', function(Blueprint $table) {
            $table->dropForeign('votes_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('votes_artikel_id_foreign');
            $table->dropColumn('artikel_id');
        });
    }
}
