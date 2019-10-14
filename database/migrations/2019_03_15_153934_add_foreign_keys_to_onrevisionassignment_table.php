<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOnrevisionassignmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('onrevisionassignment', function(Blueprint $table)
		{
			$table->foreign('assg_id', 'onrevisionassignment_ibfk_1')->references('id')->on('assignment')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'onrevisionassignment_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('onrevisionassignment', function(Blueprint $table)
		{
			$table->dropForeign('onrevisionassignment_ibfk_1');
			$table->dropForeign('onrevisionassignment_ibfk_2');
		});
	}

}
