<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->integer('district_id');
			$table->string('password');
			$table->string('api_token')->nullable();
			$table->string('pin_code')->nullable();
			$table->char('activation_report')->default('active');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}