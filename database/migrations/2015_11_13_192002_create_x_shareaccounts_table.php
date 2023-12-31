<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXShareaccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shareaccounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('member_id')->unsigned()->index('shareaccounts_member_id_foreign');
			$table->string('account_number');
			$table->date('opening_date');
            $table->integer('organization_id')->nulable();
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
		Schema::drop('shareaccounts');
	}

}
