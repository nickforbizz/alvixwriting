<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOnprogressassignmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('onprogressassignment', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('assg_id')->default(0)->index('FK_completedassignment_assignment');
			$table->integer('user_id')->default(0)->index('FK_completedassignment_users');
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
		Schema::drop('onprogressassignment');
	}

}
