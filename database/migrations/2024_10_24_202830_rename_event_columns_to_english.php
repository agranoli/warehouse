<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameEventColumnsToEnglish extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('nosaukums', 'name');
            $table->renameColumn('datums_no', 'date_from');
            $table->renameColumn('datums_lidz', 'date_to');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('name', 'nosaukums');
            $table->renameColumn('date_from', 'datums_no');
            $table->renameColumn('date_to', 'datums_lidz');
        });
    }
}
