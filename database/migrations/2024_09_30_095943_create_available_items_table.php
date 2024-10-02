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
            $table->unsignedBigInteger('item_id');
            $table->integer('available')->default(0); // Store available quantity
            $table->timestamps();

            // Foreign key linking to the items table
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('available_items');
    }
}
