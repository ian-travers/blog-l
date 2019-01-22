<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPastsAddPublishedAtColumn extends Migration
{
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->timestamp('published_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('published_at');
        });
    }
}
