<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('imageable_type');
			$table->string('imageable_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}