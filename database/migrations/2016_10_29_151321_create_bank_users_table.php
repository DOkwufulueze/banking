<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankUsersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    //
    Schema::create('bank_users', function(Blueprint $table) {
      $table->increments('id');
      $table->integer('authorization_level_id')->unsigned()->default(1);
      $table->integer('bank_user_type_id')->unsigned();
      $table->integer('bank_id')->unsigned();
      $table->integer('user_id')->unsigned();
      $table->string('token');
      $table->timestamps();
    });

    //
    Schema::table('bank_users', function(Blueprint $table) {
      $table->foreign('authorization_level_id')->references('id')->on('authorization_levels')->onDelete('cascade');
      $table->foreign('bank_user_type_id')->references('id')->on('bank_user_types')->onDelete('cascade');
      $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    //
    Schema::drop('bank_users');
  }
}
