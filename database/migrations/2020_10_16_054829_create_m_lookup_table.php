<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMLookupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_lookup', function (Blueprint $table) {
            $table->bigIncrements('lookupid');
            $table->string('keyname',100);
            $table->longText('keyvalue');
            $table->uuid('hospid');
            $table->string('stats_flag',1);
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();

            $table->foreign('hospid','m_orginfo_hospid_fk')->references('id')->on('users');
            $table->foreign('created_by','m_lookup_created_by_fk')->references('id')->on('users');
            $table->foreign('updated_by','m_lookup_updated_by_fk')->references('id')->on('users');
        });
    }
}
