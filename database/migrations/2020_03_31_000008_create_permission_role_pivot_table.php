<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionRolePivotTable extends Migration
{
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->uuid('role_id');
            $table->foreign('role_id', 'permission_role_role_id_fk')->references('id')->on('roles')->onDelete('cascade');
            $table->uuid('permission_id');
            $table->foreign('permission_id', 'permission_role_permission_id_fk')->references('id')->on('permissions')->onDelete('cascade');
        });

    }
}
