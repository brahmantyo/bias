<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetilpembayaranpiutangsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detilpembayaranpiutang', function(Blueprint $table)
		{
			$table->char('nokwitansi',15)->unique();//no kwitansi pembayaran(invoice number)
			$table->char('noreferensi',30); //kode/nomer referensi dari slip bank
			$table->enum('metode',['tunai','transfer','kredit']); //metode pembayaran
			$table->date('tglbayar'); //tgl penerimaan uang dari konsumen
			$table->double('nilaibayar',16,2);
			$table->text('keterangan',255); //berisi daftar resi yang terkait
			$table->smallInteger('iduser'); //user yang memasukan data
			$table->boolean('status'); //status validitas penerimaan pembayaran

			$table->primary('nokwitansi');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('detilpembayaranpiutang');
	}

}
