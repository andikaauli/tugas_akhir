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
            $table->string('item_code')->unique();
            $table->string('rfid_code')->nullable()->unique();
            $table->string('order_number')->nullable();
            $table->date('order_date')->nullable();
            $table->date('receipt_date')->nullable();
            $table->string('agent')->nullable();
            $table->enum('source', ['Beli', 'Hadiah']);
            $table->string('invoice')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();
            $table->foreignUuid('biblio_id')->constrained('biblio');
            $table->foreignid('book_status_id')->constrained('book_statuses');
            $table->softDeletes();  //buat softdelete
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
