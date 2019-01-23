<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersAddBioColumn extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('bio');
        });
    }
}
