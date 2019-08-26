<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTokensTable extends Migration {

	public function up()
	{
		Schema::create('tokens', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('token');
			$table->string('tokenable_type');
			$table->string('tokenable_id');
		});
	}

	public function down()
	{
		Schema::drop('tokens');
	}
}