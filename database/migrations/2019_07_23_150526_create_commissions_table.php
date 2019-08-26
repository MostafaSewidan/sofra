<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommissionsTable extends Migration {

	public function up()
	{
		Schema::create('commissions', function(Blueprint $table) {
			$table->increments('id');
			$table->string('remain_amount');
			$table->integer('resturant_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('commissions');
	}
}