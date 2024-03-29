<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppSettingsTable extends Migration {

	public function up()
	{
		Schema::create('app_settings', function(Blueprint $table) {
			$table->increments('id');
			$table->text('about_app');
			$table->text('commission_sms');
			$table->text('alahle_account');
			$table->text('alraghe_account');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('app_settings');
	}
}