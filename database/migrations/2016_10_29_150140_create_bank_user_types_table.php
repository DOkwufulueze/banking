<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankUserTypesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    //
    Schema::create('bank_user_types', function(Blueprint $table) {
      $table->increments('id');
      $table->string('name');
      $table->timestamps();
    });

    DB::table('bank_user_types')->insert(
      array(
        array('name' => 'Customer' ),
        array('name' => 'API User' )
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
    Schema::drop('bank_user_types');
  }
}
