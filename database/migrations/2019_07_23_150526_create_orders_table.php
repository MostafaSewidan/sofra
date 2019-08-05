<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('client_id');
			$table->integer('resturant_id');
			$table->text('order_notes')->nullable();
            $table->string('price')->nullable();
            $table->string('address')->nullable();
			$table->enum('state', array('pending', 'accepted', 'rejected', 'delivered', 'declined','null'))->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}