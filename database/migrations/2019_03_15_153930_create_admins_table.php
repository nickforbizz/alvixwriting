<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdminsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admins', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('national_id')->nullable();
			$table->string('email', 50)->nullable()->unique('email');
			$table->string('password')->nullable();
			$table->string('username', 50)->nullable()->unique('username');
			$table->string('fname', 50)->nullable();
			$table->string('lname', 50)->nullable();
			$table->string('sname', 50)->nullable();
			$table->integer('age')->nullable()->default(0);
			$table->enum('gender', array('Male','Female'))->nullable()->default('Male');
			$table->dateTime('email_verified_at')->nullable();
			$table->integer('mobile')->nullable();
			$table->string('roles', 50)->nullable();
			$table->string('address', 100)->nullable()->default('Male');
			$table->text('remember_token', 65535)->nullable();
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
		Schema::drop('admins');
	}

}
