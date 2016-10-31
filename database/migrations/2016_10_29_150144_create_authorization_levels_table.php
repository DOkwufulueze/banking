<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorizationLevelsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    //
    Schema::create('authorization_levels', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name');
    });

    DB::table('authorization_levels')->insert(
      array(
        array('name' => 'Basic'),
        array('name' => 'Intermediate'),
        array('name' => 'Sensitive'),
        array('name' => 'All')
      )
    );
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    //
    Schema::drop('authorization_levels');
  }
}
