<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientResturantTable extends Migration {

	public function up()
	{
		Schema::create('client_resturant', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->integer('resturant_id');
			$table->enum('rate', array(1,2,3,4,5));
			$table->string('comment');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('client_resturant');
	}
}