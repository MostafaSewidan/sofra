<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('sms_body');
			$table->string('is_read')->default('false');
			$table->timestamps();
			$table->string('contactable_type');
			$table->integer('contactable_id');
			$table->enum('type', array('Complaint', 'Suggestion', 'Enquiry'));
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}