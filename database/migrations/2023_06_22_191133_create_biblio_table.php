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
        Schema::create('biblio', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('edition');
            $table->string('isbnissn');
            $table->string('publisher');
            $table->string('year');
            $table->string('place');
            $table->string('description');
            $table->string('call_number')->unique();
            $table->string('classification');
            $table->string('author');
            $table->string('image');
            $table->string('coll_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biblio');
    }
};
