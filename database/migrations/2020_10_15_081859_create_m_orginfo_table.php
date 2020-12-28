<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMOrginfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_orginfo', function (Blueprint $table) {
            $table->uuid('hospid')->primary();
            $table->string('hospcode', 5);
            $table->string('hospname',100);
            $table->string('hospaddr1',100);
            $table->string('hospaddr2',100)->nullable();
            $table->string('hospaddr3',100)->nullable();
            $table->bigInteger('hospzip')->nullable();
            $table->string('hospcity',50);
            $table->string('hospstate',50);
            $table->string('hospcontry',50);
            $table->bigInteger('hospphone');
            $table->bigInteger('hospmobile1');
            $table->bigInteger('hospmobile2')->nullable();
            $table->string('hospemail',100);
            $table->string('hospweb',100);
            $table->string('hosplogo')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
            $table->softDeletes();
            $table->uuid('updated_by')->nullable(); 
            $table->foreign('updated_by', 'm_orginfo_updated_by_fk')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::dropIfExists('m_orginfo');
    }
}
