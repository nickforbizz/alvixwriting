<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPaidassignmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('paidassignment', function(Blueprint $table)
		{
			$table->foreign('assg_id', 'paidassignment_ibfk_1')->references('id')->on('assignment')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'paidassignment_ibfk_2')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('paidassignment', function(Blueprint $table)
		{
			$table->dropForeign('paidassignment_ibfk_1');
			$table->dropForeign('paidassignment_ibfk_2');
		});
	}

}
