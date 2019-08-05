<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateResturantsTable extends Migration {

	public function up()
	{
		Schema::create('resturants', function(Blueprint $table) {
			$table->increments('id');
            $table->integer('district_id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->string('min_charge');
			$table->string('deliver_cost');
			$table->string('whats_app');
			$table->string('rate')->nullable();
			$table->char('state')->nullable();
			$table->char('payment_activate')->nullable();
			$table->char('activation_report')->nullable();
			$table->string('api_token')->nullable();
			$table->string('pin_code')->nullable();
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('resturants');
	}
}