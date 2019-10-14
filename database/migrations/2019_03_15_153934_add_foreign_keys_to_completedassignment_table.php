<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCompletedassignmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('completedassignment', function(Blueprint $table)
		{
			$table->foreign('assg_id', 'FK_completedassignment_assignment')->references('id')->on('assignment')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'FK_completedassignment_users')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('completedassignment', function(Blueprint $table)
		{
			$table->dropForeign('FK_completedassignment_assignment');
			$table->dropForeign('FK_completedassignment_users');
		});
	}

}
