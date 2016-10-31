<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsAccessRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
    //
    Schema::create('user_details_access_requests', function(Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->integer('requester_id')->unsigned();
      $table->integer('detail_id')->unsigned();
      $table->integer('seen');
      $table->integer('granted');
      $table->timestamps();
    });

    //
    Schema::table('user_details_access_requests', function(Blueprint $table) {
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('requester_id')->references('id')->on('users')->onDelete('cascade');
      $table->foreign('detail_id')->references('id')->on('user_details')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    //
    Schema::drop('user_details_access_requests');
  }
}
