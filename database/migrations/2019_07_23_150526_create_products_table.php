<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('offer_price');
			$table->text('details');
			$table->time('prepare_time');
			$table->integer('resturant_id')->nullable();
			$table->timestamps();
			$table->string('price');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}