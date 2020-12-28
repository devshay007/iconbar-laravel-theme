<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMRightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_rights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',50);
            $table->string('link')->nullable();
            $table->bigInteger('parent_id')->default(0);
            $table->tinyInteger('status')->default(1)->comment='1=Active, 0=Inactive';
            $table->timestamp('created_at');
            $table->timestamp('updated_at')->nullable();
        });
    }
}
