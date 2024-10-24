<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuantityToRentsTable extends Migration
{
    public function up()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->integer('quantity')->default(1)->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('rents', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
}
