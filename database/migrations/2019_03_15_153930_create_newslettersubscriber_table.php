<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNewslettersubscriberTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('newslettersubscriber', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('email', 100)->default('0');
			$table->integer('remember_token')->nullable();
			$table->integer('status')->nullable()->default(1);
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('newslettersubscriber');
	}

}
