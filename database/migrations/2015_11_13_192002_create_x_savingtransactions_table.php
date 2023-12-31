<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXSavingtransactionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('savingtransactions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date');
			$table->integer('savingaccount_id')->unsigned()->index('savingtransactions_savingaccount_id_foreign');
			$table->float('amount', 12);
			$table->string('type');
			$table->string('description')->nullable();
            $table->integer('organization_id')->nulable();
            $table->string('transacted_by')->nullable();
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
		Schema::drop('savingtransactions');
	}

}
