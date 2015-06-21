<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductencategorieTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productencategorie', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('articles_id')->unsigned()->index();
			$table->foreign('articles_id')->references('id')->on('articles')->onDelete('cascade');
			$table->integer('categorie_id')->unsigned()->index();
			$table->foreign('categorie_id')->references('id')->on('categorieen')->onDelete('cascade');
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
		Schema::drop('productencategorie');
	}

}
