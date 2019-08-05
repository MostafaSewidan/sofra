<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('order_id');
            $table->string('title');
            $table->string('body');
            $table->char('is_read');
			$table->string('notifiable_type');
			$table->integer('notifiable_id');
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}