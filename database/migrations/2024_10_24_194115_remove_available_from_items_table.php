<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveAvailableFromItemsTable extends Migration
{
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('available');
        });
    }

    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('available')->default(0);
        });
    }
}