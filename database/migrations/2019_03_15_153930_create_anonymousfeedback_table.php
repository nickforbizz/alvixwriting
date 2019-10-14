<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnonymousfeedbackTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('anonymousfeedback', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('email', 50)->nullable()->unique('email');
			$table->string('Title', 50)->nullable();
			$table->text('message', 65535)->nullable();
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
		Schema::drop('anonymousfeedback');
	}

}
