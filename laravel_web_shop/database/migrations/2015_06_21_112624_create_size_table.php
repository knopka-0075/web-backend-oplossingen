<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSizeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sizes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('size');
			$table->timestamps();
		});
		Schema::create('articl_size', function(Blueprint $table)
		{
			$table->integer('articl_id')->unsigned()->index();
			$table->foreign('articl_id')->references('id')->on('articles')->onDelete('cascade');
			$table->integer('size_id')->unsigned()->index();
			$table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('articl_size');
		Schema::drop('sizes');
	}

}

