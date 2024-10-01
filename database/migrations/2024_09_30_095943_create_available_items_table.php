<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailableItemsTable extends Migration
{
    public function up()
    {
        Schema::create('available_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')->constrained('items')->onDelete('cascade');
            $table->integer('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('available_items');
    }
}
