<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eksemplar', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('inventory_code');
            $table->string('call_number');
            $table->string('item_code');
            $table->string('rfid_code')->unique();
            $table->timestamps();
            $table->foreignUuid('biblio_id')->constrained('biblio');
            $table->foreignid('book_status_id')->constrained('book_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eksemplar');
    }
};
