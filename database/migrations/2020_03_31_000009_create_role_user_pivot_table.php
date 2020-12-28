<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->foreign('user_id', 'role_user_user_id_fk')->references('id')->on('users')->onDelete('cascade');
            $table->uuid('role_id');
            $table->foreign('role_id', 'role_user_role_id_fk')->references('id')->on('roles')->onDelete('cascade');
        });

    }
}
