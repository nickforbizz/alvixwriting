<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAssignmentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignment', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id')->default(0)->index('FK_assignment_users');
			$table->string('title')->default('0');
			$table->string('category')->default('0');
			$table->text('description', 65535);
			$table->integer('pages')->default(1);
			$table->integer('words')->default(273);
			$table->string('image_link', 50)->nullable();
			$table->string('video_link', 50)->nullable();
			$table->integer('remember_token')->nullable();
			$table->integer('status')->nullable()->default(1);
			$table->timestamp('deadline')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
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
		Schema::drop('assignment');
	}

}
