<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('nosaukums');        // Event name
            $table->date('datums_no');          // Date from
            $table->date('datums_lidz');        // Date to
            $table->string('file')->nullable(); // Event file (image) path
            $table->timestamps();
        });

        // Pivot table to associate events with users (many-to-many relationship)
        Schema::create('event_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_user');  // Drop pivot table first
        Schema::dropIfExists('events');
    }
}
