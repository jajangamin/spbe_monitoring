<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDefaultRoleIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('users', function (Blueprint $table) {
            //
			$table->dropForeign('users_role_id_foreign');
			$table->dropColumn('role_id');
        });
        Schema::table('users', function (Blueprint $table) {
            //
            $table->bigInteger('role_id')->unsigned()->nullable()->after('id')->default(2);
			$table->foreign('role_id')->references('id')->on('roles');
        });
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::table('users', function (Blueprint $table) {
            //
			$table->dropForeign('users_role_id_foreign');
			$table->dropColumn('role_id');
        });
        Schema::table('users', function (Blueprint $table) {
            //
            $table->bigInteger('role_id')->unsigned()->nullable()->after('id')->default(null);
			$table->foreign('role_id')->references('id')->on('roles');
        });
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
