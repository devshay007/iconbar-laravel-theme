<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMLookupfixedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_lookupfixed', function (Blueprint $table) {
            $table->bigIncrements('lookupfixid');
            $table->string('keyname',100);
            $table->longText('keyvalue');
        });
    }
}
